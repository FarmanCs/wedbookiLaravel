<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Stripe\Webhook;
use Stripe\Stripe;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Subscription\CreditsTransaction;
use App\Models\Business\Business;
use App\Models\Subscription\Credits;
use App\Models\Subscription\Subscription;
use App\Models\Subscription\PlanTransaction;
use App\Models\Subscription\Plan;
use App\Models\Vendor\VendorPurchase;
use Exception;

class StripeWebhookController extends Controller
{
    /**
     * Handle incoming Stripe webhook
     */
    public function __invoke(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        $endpointSecret = config('services.stripe.webhook_secret');
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        // ✅ Log webhook reception for debugging
        Log::info('[Webhook] ========== RECEIVED REQUEST ==========', [
            'has_signature' => !empty($sigHeader),
            'payload_size' => strlen($payload) . ' bytes',
            'webhook_secret_configured' => !empty($endpointSecret),
            'timestamp' => now()->toIso8601String(),
        ]);

        // ── Verify webhook signature ───────────────────────────────────────
        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
            Log::info('[Webhook] ✅ Signature verified', [
                'event_type' => $event->type,
                'event_id' => $event->id,
            ]);
        } catch (\UnexpectedValueException $e) {
            Log::error('[Webhook] ❌ Invalid payload', [
                'error' => $e->getMessage(),
                'payload_size' => strlen($payload),
            ]);
            return response('Invalid payload', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            Log::error('[Webhook] ❌ Signature verification failed', [
                'error' => $e->getMessage(),
                'webhook_secret_prefix' => $endpointSecret ? substr($endpointSecret, 0, 10) . '...' : 'NOT SET',
                'sig_header_present' => !empty($sigHeader),
            ]);
            return response('Invalid signature', 400);
        }

        // ── Route events ───────────────────────────────────────────────────
        match ($event->type) {
            'checkout.session.completed' => $this->handleCheckoutCompleted($event->data->object),
            'checkout.session.expired'   => $this->handleCheckoutExpired($event->data->object),
            default                      => Log::info('[Webhook] Unhandled event type: ' . $event->type),
        };

        Log::info('[Webhook] ========== REQUEST COMPLETE ==========');
        return response('Webhook handled', Response::HTTP_OK);
    }

    /**
     * Handle checkout.session.completed event
     * This is the main entry point for processing payments
     */
    private function handleCheckoutCompleted(object $session): void
    {
        Log::info('[Webhook:CheckoutCompleted] ========== STARTING PROCESSING ==========', [
            'session_id' => $session->id,
            'payment_status' => $session->payment_status,
            'amount_total' => $session->amount_total / 100,
            'timestamp' => now()->toIso8601String(),
        ]);

        $metadata = $session->metadata->toArray();
        $vendorId = $metadata['vendor_id'] ?? null;
        $businessId = $metadata['business_id'] ?? null;
        $type = $metadata['type'] ?? null;
        $amount = $session->amount_total / 100;

        Log::info('[Webhook:CheckoutCompleted] Parsed metadata', [
            'vendor_id' => $vendorId,
            'business_id' => $businessId,
            'type' => $type,
            'has_cart' => isset($metadata['cart']),
            'amount' => $amount,
            'all_metadata_keys' => array_keys($metadata),
        ]);

        // ── Validate required metadata ───────────────────────────────────────
        if (!$vendorId || !$businessId) {
            Log::error('[Webhook:CheckoutCompleted] ❌ FAILED: Missing vendor_id or business_id', [
                'session_id' => $session->id,
                'vendor_id' => $vendorId,
                'business_id' => $businessId,
                'metadata' => $metadata,
            ]);
            return;
        }

        // ── Verify business exists ───────────────────────────────────────────
        $business = Business::where('id', $businessId)->first();
        if (!$business) {
            Log::error('[Webhook:CheckoutCompleted] ❌ FAILED: Business not found', [
                'session_id' => $session->id,
                'business_id' => $businessId,
            ]);
            return;
        }

        Log::info('[Webhook:CheckoutCompleted] Business verified', [
            'business_name' => $business->company_name ?? 'N/A',
            'business_id' => $business->id,
        ]);

        // ── Use MySQL transaction for ACID safety ────────────────────────────
        DB::beginTransaction();
        try {
            // ── Check for idempotency: If this session was already processed, skip ──
            if ($this->sessionAlreadyProcessed($session->id)) {
                Log::info('[Webhook:CheckoutCompleted] ℹ️  Idempotency check: Session already processed', [
                    'session_id' => $session->id,
                ]);
                DB::commit();
                return;
            }

            if (isset($metadata['cart'])) {
                Log::info('[Webhook:CheckoutCompleted] → Routing to CART checkout handler');
                $this->handleCartCheckout($session, $metadata, $amount, $business, $vendorId, $businessId);
            } elseif ($type === 'credit') {
                Log::info('[Webhook:CheckoutCompleted] → Routing to CREDIT checkout handler');
                $this->handleCreditCheckout($session, $metadata, $amount, $business, $vendorId, $businessId);
            } elseif ($type === 'plan') {
                Log::info('[Webhook:CheckoutCompleted] → Routing to PLAN checkout handler');
                $this->handlePlanCheckout($session, $metadata, $amount, $business, $vendorId, $businessId);
            } else {
                Log::warning('[Webhook:CheckoutCompleted] ⚠️  No cart or recognized type in metadata', [
                    'session_id' => $session->id,
                    'type' => $type,
                    'metadata' => $metadata,
                ]);
            }

            DB::commit();
            Log::info('[Webhook:CheckoutCompleted] ========== ✅ SUCCESS ==========', [
                'session_id' => $session->id,
                'business_id' => $businessId,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('[Webhook:CheckoutCompleted] ========== ❌ FAILED ==========', [
                'session_id' => $session->id,
                'error_message' => $e->getMessage(),
                'error_class' => get_class($e),
                'error_file' => $e->getFile() . ':' . $e->getLine(),
                'error_trace' => $e->getTraceAsString(),
                'metadata' => $metadata,
            ]);
            // Re-throw to ensure webhook fails and Stripe retries if needed
            throw $e;
        }
    }

    /**
     * Check if a session has already been processed (idempotency)
     */
    private function sessionAlreadyProcessed(string $sessionId): bool
    {
        return CreditsTransaction::where('stripe_session_id', $sessionId)->exists()
            || PlanTransaction::where('stripe_session_id', $sessionId)->exists()
            || VendorPurchase::where('stripe_session_id', $sessionId)->exists();
    }

    /**
     * Handle single credit plan purchase
     */
    private function handleCreditCheckout(object $session, array $metadata, float $amount, Business $business, $vendorId, $businessId): void
    {
        Log::info('[CreditCheckout] Starting credit transaction processing...');

        // ── Validate metadata ────────────────────────────────────────────────
        $creditPlanId = $metadata['credit_id'] ?? null;
        $credits = (int) ($metadata['credits'] ?? 0);

        Log::info('[CreditCheckout] Extracted metadata', [
            'credit_id' => $creditPlanId,
            'credits' => $credits,
            'amount' => $amount,
        ]);

        if (!$creditPlanId || $credits <= 0) {
            Log::error('[CreditCheckout] ❌ Invalid credit data', [
                'session_id' => $session->id,
                'credit_plan_id' => $creditPlanId,
                'credits' => $credits,
            ]);
            throw new Exception('Invalid credit data in metadata');
        }

        // ── Verify credit plan exists ───────────────────────────────────────
        $plan = Credits::find($creditPlanId);
        if (!$plan) {
            Log::error('[CreditCheckout] ❌ Credit plan not found', [
                'session_id' => $session->id,
                'credit_plan_id' => $creditPlanId,
            ]);
            throw new Exception("Credit plan {$creditPlanId} not found");
        }

        Log::info('[CreditCheckout] Plan verified', [
            'plan_name' => $plan->name,
            'plan_id' => $plan->id,
        ]);

        // ── Create credits transaction ──────────────────────────────────────
        try {
            $transaction = CreditsTransaction::create([
                'business_id' => $businessId,
                'vendor_id' => $vendorId,
                'credit_id' => $creditPlanId,
                'no_of_credits' => $credits,
                'amount' => $amount,
                'stripe_session_id' => $session->id,
                'payment_intent_id' => $session->payment_intent,
                'status' => 'completed',
                'tran_type' => 'purchase',
                'from' => now(),
                'to' => null,
            ]);

            Log::info('[CreditCheckout] ✅ Credits transaction created', [
                'transaction_id' => $transaction->id,
                'credits' => $credits,
                'amount' => $amount,
            ]);
        } catch (Exception $e) {
            Log::error('[CreditCheckout] ❌ Failed to create transaction', [
                'error' => $e->getMessage(),
                'file' => $e->getFile() . ':' . $e->getLine(),
            ]);
            throw $e;
        }

        // ── Increment business credits ──────────────────────────────────────
        try {
            $oldCredits = $business->ad_credits ?? 0;
            $business->increment('ad_credits', $credits);
            $newCredits = $business->fresh()->ad_credits;

            Log::info('[CreditCheckout] ✅ Business credits updated', [
                'old_credits' => $oldCredits,
                'added_credits' => $credits,
                'new_credits' => $newCredits,
            ]);
        } catch (Exception $e) {
            Log::error('[CreditCheckout] ❌ Failed to increment credits', [
                'error' => $e->getMessage(),
                'file' => $e->getFile() . ':' . $e->getLine(),
            ]);
            throw $e;
        }

        Log::info('[CreditCheckout] ✅ COMPLETED');
    }

    /**
     * Handle single subscription plan purchase
     */
    private function handlePlanCheckout(object $session, array $metadata, float $amount, Business $business, $vendorId, $businessId): void
    {
        Log::info('[PlanCheckout] Starting plan transaction processing...');

        // ── Validate metadata ────────────────────────────────────────────────
        $planId = $metadata['plan_id'] ?? null;
        $cycle = $metadata['cycle'] ?? 'quarterly';

        Log::info('[PlanCheckout] Extracted metadata', [
            'plan_id' => $planId,
            'cycle' => $cycle,
            'amount' => $amount,
        ]);

        if (!$planId) {
            Log::error('[PlanCheckout] ❌ No plan_id in metadata', [
                'session_id' => $session->id,
                'metadata' => $metadata,
            ]);
            throw new Exception('No plan_id in metadata');
        }

        // ── Verify plan exists ──────────────────────────────────────────────
        $plan = Plan::find($planId);
        if (!$plan) {
            Log::error('[PlanCheckout] ❌ Plan not found', [
                'session_id' => $session->id,
                'plan_id' => $planId,
            ]);
            throw new Exception("Plan {$planId} not found");
        }

        Log::info('[PlanCheckout] Plan verified', [
            'plan_name' => $plan->name,
            'plan_id' => $plan->id,
        ]);

        // ── Calculate subscription end date ────────────────────────────────
        $endDate = match ($cycle) {
            'monthly'   => now()->addMonth(),
            'quarterly' => now()->addQuarter(),
            'annually'  => now()->addYear(),
            default     => now()->addMonth(),
        };

        Log::info('[PlanCheckout] Subscription dates', [
            'start_date' => now()->toDateString(),
            'end_date' => $endDate->toDateString(),
            'cycle' => $cycle,
        ]);

        // ── Create subscription ────────────────────────────────────────────
        try {
            $subscription = Subscription::create([
                'business_id' => $businessId,
                'plan_id' => $planId,
                'start_date' => now(),
                'end_date' => $endDate,
                'subscription_type' => $cycle === 'annually' ? 'yearly' : $cycle,
                'amount' => $amount,
                'status' => 'active',
            ]);

            Log::info('[PlanCheckout] ✅ Subscription created', [
                'subscription_id' => $subscription->id,
                'amount' => $amount,
            ]);
        } catch (Exception $e) {
            Log::error('[PlanCheckout] ❌ Failed to create subscription', [
                'error' => $e->getMessage(),
                'file' => $e->getFile() . ':' . $e->getLine(),
            ]);
            throw $e;
        }

        // ── Create plan transaction ───────────────────────────────────────
        try {
            $transaction = PlanTransaction::create([
                'business_id' => $businessId,
                'plan_id' => $planId,
                'transaction_time' => now(),
                'start_at' => now(),
                'end_at' => $endDate,
                'amount' => $amount,
                'transaction_type' => 'purchase',
                'stripe_session_id' => $session->id,
                'payment_intent_id' => $session->payment_intent,
                'status' => 'completed',
            ]);

            Log::info('[PlanCheckout] ✅ Plan transaction created', [
                'transaction_id' => $transaction->id,
                'amount' => $amount,
                'end_at' => $endDate->toDateString(),
            ]);
        } catch (Exception $e) {
            Log::error('[PlanCheckout] ❌ Failed to create transaction', [
                'error' => $e->getMessage(),
                'file' => $e->getFile() . ':' . $e->getLine(),
            ]);
            throw $e;
        }

        Log::info('[PlanCheckout] ✅ COMPLETED');
    }

    /**
     * Handle cart purchase (multiple credits and/or plans)
     */
    private function handleCartCheckout(object $session, array $metadata, float $amount, Business $business, $vendorId, $businessId): void
    {
        Log::info('[CartCheckout] Starting cart processing...');

        // ── Parse cart ────────────────────────────────────────────────────────
        $cart = json_decode($metadata['cart'] ?? '[]', true);

        Log::info('[CartCheckout] Cart contents', [
            'cart_items_count' => count($cart),
            'cart_json' => $metadata['cart'] ?? '[]',
        ]);

        if (!is_array($cart) || empty($cart)) {
            Log::error('[CartCheckout] ❌ Invalid or empty cart', [
                'session_id' => $session->id,
                'cart_type' => gettype($cart),
                'cart_empty' => empty($cart),
            ]);
            throw new Exception('Invalid or empty cart');
        }

        // ── Create vendor purchase record ────────────────────────────────────
        try {
            VendorPurchase::create([
                'vendor_id' => $vendorId,
                'business_id' => $businessId,
                'cart_items' => json_encode($cart),
                'total_amount' => $amount,
                'stripe_session_id' => $session->id,
                'payment_intent_id' => $session->payment_intent,
                'status' => 'completed',
            ]);

            Log::info('[CartCheckout] ✅ Vendor purchase record created');
        } catch (Exception $e) {
            Log::error('[CartCheckout] ❌ Failed to create vendor purchase', [
                'error' => $e->getMessage(),
                'file' => $e->getFile() . ':' . $e->getLine(),
            ]);
            throw $e;
        }

        // ── Process each cart item ────────────────────────────────────────────
        foreach ($cart as $index => $item) {
            Log::info("[CartCheckout] Processing item {$index}/" . count($cart), [
                'type' => $item['type'] ?? 'unknown',
                'item' => $item,
            ]);

            try {
                if ($item['type'] === 'credit') {
                    $this->processCartCredit($item, $session, $business, $vendorId, $businessId);
                } elseif ($item['type'] === 'plan') {
                    $this->processCartPlan($item, $session, $business, $businessId);
                } else {
                    Log::warning('[CartCheckout] Unknown item type in cart', [
                        'index' => $index,
                        'type' => $item['type'] ?? 'null',
                    ]);
                }
            } catch (Exception $e) {
                Log::error("[CartCheckout] ❌ Failed to process item {$index}", [
                    'error' => $e->getMessage(),
                    'item_type' => $item['type'] ?? 'unknown',
                    'file' => $e->getFile() . ':' . $e->getLine(),
                ]);
                throw $e;
            }
        }

        Log::info('[CartCheckout] ✅ COMPLETED - All items processed');
    }

    /**
     * Process a single credit item from cart
     */
    private function processCartCredit(array $item, object $session, Business $business, $vendorId, $businessId): void
    {
        $creditPlanId = $item['id'] ?? null;
        $credits = (int) ($item['credits'] ?? 0);
        $quantity = (int) ($item['quantity'] ?? 1);
        $price = (float) ($item['price'] ?? 0);

        Log::info('[CartCredit] Processing', [
            'credit_id' => $creditPlanId,
            'credits_per_unit' => $credits,
            'quantity' => $quantity,
            'unit_price' => $price,
        ]);

        if (!$creditPlanId || $credits <= 0 || $quantity <= 0) {
            Log::warning('[CartCredit] ⚠️  Invalid data, skipping', [
                'credit_plan_id' => $creditPlanId,
                'credits' => $credits,
                'quantity' => $quantity,
            ]);
            return;
        }

        // Verify plan exists
        $plan = Credits::find($creditPlanId);
        if (!$plan) {
            throw new Exception("Credit plan {$creditPlanId} not found in cart processing");
        }

        $totalCredits = $credits * $quantity;
        $totalPrice = $price * $quantity;

        // ── Create credit transaction ───────────────────────────────────────
        try {
            $transaction = CreditsTransaction::create([
                'business_id' => $businessId,
                'vendor_id' => $vendorId,
                'credit_id' => $creditPlanId,
                'no_of_credits' => $totalCredits,
                'amount' => $totalPrice,
                'stripe_session_id' => $session->id,
                'payment_intent_id' => $session->payment_intent,
                'status' => 'completed',
                'tran_type' => 'purchase',
                'from' => now(),
                'to' => null,
            ]);

            Log::info('[CartCredit] ✅ Transaction created', [
                'transaction_id' => $transaction->id,
                'total_credits' => $totalCredits,
            ]);
        } catch (Exception $e) {
            Log::error('[CartCredit] ❌ Failed to create transaction', [
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }

        // ── Add credits to business ─────────────────────────────────────────
        try {
            $business->increment('ad_credits', $totalCredits);

            Log::info('[CartCredit] ✅ Credits incremented', [
                'added' => $totalCredits,
                'new_total' => $business->fresh()->ad_credits,
            ]);
        } catch (Exception $e) {
            Log::error('[CartCredit] ❌ Failed to increment credits', [
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }

    /**
     * Process a single plan item from cart
     */
    private function processCartPlan(array $item, object $session, Business $business, $businessId): void
    {
        $planId = $item['id'] ?? null;
        $cycle = $item['cycle'] ?? 'quarterly';
        $price = (float) ($item['price'] ?? 0);

        Log::info('[CartPlan] Processing', [
            'plan_id' => $planId,
            'cycle' => $cycle,
            'price' => $price,
        ]);

        if (!$planId || $price <= 0) {
            Log::warning('[CartPlan] ⚠️  Invalid data, skipping', [
                'plan_id' => $planId,
                'price' => $price,
            ]);
            return;
        }

        // ── Verify plan exists ──────────────────────────────────────────────
        $plan = Plan::find($planId);
        if (!$plan) {
            throw new Exception("Plan {$planId} not found in cart processing");
        }

        // ── Calculate end date ──────────────────────────────────────────────
        $endDate = match ($cycle) {
            'monthly'   => now()->addMonth(),
            'quarterly' => now()->addQuarter(),
            'annually'  => now()->addYear(),
            default     => now()->addMonth(),
        };

        // ── Create subscription ────────────────────────────────────────────
        try {
            $subscription = Subscription::create([
                'business_id' => $businessId,
                'plan_id' => $planId,
                'start_date' => now(),
                'end_date' => $endDate,
                'subscription_type' => $cycle === 'annually' ? 'yearly' : $cycle,
                'amount' => $price,
                'status' => 'active',
            ]);

            Log::info('[CartPlan] ✅ Subscription created', [
                'subscription_id' => $subscription->id,
            ]);
        } catch (Exception $e) {
            Log::error('[CartPlan] ❌ Failed to create subscription', [
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }

        // ── Create plan transaction ───────────────────────────────────────
        try {
            $transaction = PlanTransaction::create([
                'business_id' => $businessId,
                'plan_id' => $planId,
                'transaction_time' => now(),
                'start_at' => now(),
                'end_at' => $endDate,
                'amount' => $price,
                'transaction_type' => 'purchase',
                'stripe_session_id' => $session->id,
                'payment_intent_id' => $session->payment_intent,
                'status' => 'completed',
            ]);

            Log::info('[CartPlan] ✅ Transaction created', [
                'transaction_id' => $transaction->id,
                'end_at' => $endDate->toDateString(),
            ]);
        } catch (Exception $e) {
            Log::error('[CartPlan] ❌ Failed to create transaction', [
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }

    /**
     * Handle checkout session expiration
     */
    private function handleCheckoutExpired(object $session): void
    {
        Log::info('[Webhook] Session expired', [
            'session_id' => $session->id,
        ]);

        DB::beginTransaction();
        try {
            // Mark any pending transactions as failed
            CreditsTransaction::where('stripe_session_id', $session->id)
                ->where('status', 'pending')
                ->update(['status' => 'failed']);

            PlanTransaction::where('stripe_session_id', $session->id)
                ->where('status', 'pending')
                ->update(['status' => 'failed']);

            VendorPurchase::where('stripe_session_id', $session->id)
                ->where('status', 'pending')
                ->update(['status' => 'failed']);

            DB::commit();
            Log::info('[Webhook] Expired session handled');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('[Webhook] Failed to handle expired session', [
                'session_id' => $session->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
