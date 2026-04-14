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
use App\Models\Subscription\CreditPlan;
use App\Models\Subscription\Subscription;
use App\Models\Subscription\PlanTransaction;
use App\Models\Vendor\VendorPurchase;

class StripeWebhookController extends Controller
{
    public function __invoke(Request $request)
    {
        // CORRECT key: config/services.php → 'secret' => env('STRIPE_SECRET_KEY')
        Stripe::setApiKey(config('services.stripe.secret'));

        $endpointSecret = config('services.stripe.webhook_secret');
        $payload        = $request->getContent();
        $sigHeader      = $request->header('Stripe-Signature');

        // ── 1. Verify webhook signature ───────────────────────────────────────
        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
        } catch (\UnexpectedValueException $e) {
            Log::error('[Webhook] Invalid payload: ' . $e->getMessage(), ['payload' => $payload]);
            return response('Invalid payload', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            Log::error('[Webhook] Invalid signature: ' . $e->getMessage(), [
                'error' => $e->getMessage(),
                'sig_header' => $sigHeader,
                'secret_prefix' => substr($endpointSecret, 0, 10) . '...'
            ]);
            return response('Invalid signature', 400);
        }

        // ── 2. Route events ───────────────────────────────────────────────────
        match ($event->type) {
            'checkout.session.completed' => $this->handleCheckoutCompleted($event->data->object),
            'checkout.session.expired'   => $this->handleCheckoutExpired($event->data->object),
            default                      => Log::info('[Webhook] Unhandled event: ' . $event->type),
        };

        return response('Webhook handled', Response::HTTP_OK);
    }

    private function handleCheckoutCompleted(object $session): void
    {
        Log::info('[Webhook] Processing checkout.session.completed', [
            'session_id' => $session->id,
            'metadata' => (array) $session->metadata,
        ]);

        $metadata = (array) $session->metadata;
        $vendorId = $metadata['vendor_id'] ?? null;
        $businessId = $metadata['business_id'] ?? null;
        $amount = $session->amount_total / 100;
        $type = $metadata['type'] ?? null;

        // Validate required metadata
        if (!$vendorId || !$businessId) {
            Log::error('[Webhook] Missing vendor_id or business_id', [
                'session_id' => $session->id,
                'metadata' => $metadata,
            ]);
            return;
        }

        // Verify business exists
        $business = Business::where('id', $businessId)->first();
        if (!$business) {
            Log::error("[Webhook] Business {$businessId} not found for session {$session->id}");
            return;
        }

        // Use MySQL transaction for ACID safety - all or nothing
        try {
            DB::transaction(function () use ($session, $metadata, $amount, $type, $business, $vendorId, $businessId) {
                if (isset($metadata['cart'])) {
                    // ── Handle cart purchase ──────────────────────────────────────
                    $this->handleCartCheckout($session, $metadata, $amount, $business, $vendorId, $businessId);
                } elseif ($type === 'credit') {
                    // ── Handle single credit plan purchase ────────────────────────
                    $this->handleCreditCheckout($session, $metadata, $amount, $business, $vendorId, $businessId);
                } elseif ($type === 'plan') {
                    // ── Handle single plan purchase ───────────────────────────────
                    $this->handlePlanCheckout($session, $metadata, $amount, $business, $vendorId, $businessId);
                } else {
                    Log::warning('[Webhook] Unknown purchase type', [
                        'session_id' => $session->id,
                        'metadata' => $metadata,
                    ]);
                }
            }, attempts: 3); // Retry up to 3 times on deadlock

            Log::info('[Webhook] Checkout processed successfully', [
                'session_id' => $session->id,
                'business_id' => $businessId,
            ]);
        } catch (\Exception $e) {
            Log::error('[Webhook] Transaction failed: ' . $e->getMessage(), [
                'session_id' => $session->id,
                'exception' => get_class($e),
            ]);
            throw $e;
        }
    }

    /**
     * Handle single credit plan purchase (ACID safe)
     */
    private function handleCreditCheckout(object $session, array $metadata, float $amount, Business $business, $vendorId, $businessId): void
    {
        // Idempotency check
        if (CreditsTransaction::where('stripe_session_id', $session->id)->exists()) {
            Log::info('[Webhook] Credit transaction already processed: ' . $session->id);
            return;
        }

        $creditPlanId = $metadata['credit_plan_id'] ?? null;
        $credits = (int) ($metadata['credits'] ?? 0);

        if (!$creditPlanId || $credits <= 0) {
            Log::error('[Webhook] Invalid credit plan data', [
                'session_id' => $session->id,
                'credit_plan_id' => $creditPlanId,
                'credits' => $credits,
            ]);
            return;
        }

        $plan = CreditPlan::find($creditPlanId);
        if (!$plan) {
            Log::error("[Webhook] Credit plan {$creditPlanId} not found");
            return;
        }

        // Create vendor purchase record
        VendorPurchase::create([
            'vendor_id' => $vendorId,
            'business_id' => $businessId,
            'cart_items' => json_encode([
                [
                    'type' => 'credit',
                    'id' => $creditPlanId,
                    'name' => $plan->name,
                    'credits' => $credits,
                    'price' => $amount,
                    'quantity' => 1,
                ],
            ]),
            'total_amount' => $amount,
            'stripe_session_id' => $session->id,
            'payment_intent_id' => $session->payment_intent,
            'status' => 'completed',
        ]);

        // Add credits to business
        $business->increment('ad_credits', $credits);

        // Record credit transaction
        CreditsTransaction::create([
            'business_id' => $businessId,
            'vendor_id' => $vendorId,
            'credit_plan_id' => $creditPlanId,
            'no_of_credits' => $credits,
            'amount' => $amount,
            'stripe_session_id' => $session->id,
            'payment_intent_id' => $session->payment_intent,
            'status' => 'completed',
            'tran_type' => 'purchase',
            'from' => now(),
            'to' => null,
        ]);

        Log::info('[Webhook] Credit plan purchased', [
            'session_id' => $session->id,
            'business_id' => $businessId,
            'credits' => $credits,
        ]);
    }

    /**
     * Handle single subscription plan purchase (ACID safe)
     */
    private function handlePlanCheckout(object $session, array $metadata, float $amount, Business $business, $vendorId, $businessId): void
    {
        // Idempotency check
        if (PlanTransaction::where('stripe_session_id', $session->id)->exists()) {
            Log::info('[Webhook] Plan transaction already processed: ' . $session->id);
            return;
        }

        $planId = $metadata['plan_id'] ?? null;
        $cycle = $metadata['cycle'] ?? 'quarterly';

        if (!$planId) {
            Log::error('[Webhook] Invalid plan data', [
                'session_id' => $session->id,
                'plan_id' => $planId,
            ]);
            return;
        }

        $plan = \App\Models\Subscription\Plan::find($planId);
        if (!$plan) {
            Log::error("[Webhook] Plan {$planId} not found");
            return;
        }

        // Calculate end date based on cycle
        $endDate = match ($cycle) {
            'monthly' => now()->addMonth(),
            'quarterly' => now()->addQuarter(),
            'annually' => now()->addYear(),
            default => now()->addMonth(),
        };

        // Create subscription record
        Subscription::create([
            'business_id' => $businessId,
            'plan_id' => $planId,
            'start_date' => now(),
            'end_date' => $endDate,
            'subscription_type' => $cycle === 'annually' ? 'yearly' : $cycle,
            'amount' => $amount,
            'status' => 'active',
        ]);

        // Create plan transaction record with Stripe metadata
        PlanTransaction::create([
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

        Log::info('[Webhook] Plan subscribed', [
            'session_id' => $session->id,
            'business_id' => $businessId,
            'plan_id' => $planId,
            'cycle' => $cycle,
        ]);
    }

    /**
     * Handle cart purchase (multiple credits and/or plans) with ACID safety
     */
    private function handleCartCheckout(object $session, array $metadata, float $amount, Business $business, $vendorId, $businessId): void
    {
        $cart = json_decode($metadata['cart'] ?? '[]', true);

        if (!is_array($cart) || empty($cart)) {
            Log::error('[Webhook] Invalid or empty cart', [
                'session_id' => $session->id,
                'cart' => $metadata['cart'] ?? null,
            ]);
            return;
        }

        // Idempotency check - verify no part of cart was processed
        foreach ($cart as $item) {
            if ($item['type'] === 'credit') {
                if (CreditsTransaction::where('stripe_session_id', $session->id)->exists()) {
                    Log::info('[Webhook] Cart already processed: ' . $session->id);
                    return;
                }
            } elseif ($item['type'] === 'plan') {
                if (PlanTransaction::where('stripe_session_id', $session->id)->exists()) {
                    Log::info('[Webhook] Cart already processed: ' . $session->id);
                    return;
                }
            }
        }

        // Create vendor purchase record
        VendorPurchase::create([
            'vendor_id' => $vendorId,
            'business_id' => $businessId,
            'cart_items' => json_encode($cart),
            'total_amount' => $amount,
            'stripe_session_id' => $session->id,
            'payment_intent_id' => $session->payment_intent,
            'status' => 'completed',
        ]);

        // Process each item in cart
        foreach ($cart as $item) {
            if ($item['type'] === 'credit') {
                $this->processCartCredit($item, $session, $business, $vendorId, $businessId);
            } elseif ($item['type'] === 'plan') {
                $this->processCartPlan($item, $session, $business, $businessId);
            }
        }

        Log::info('[Webhook] Cart processed', [
            'session_id' => $session->id,
            'business_id' => $businessId,
            'items' => count($cart),
        ]);
    }

    /**
     * Process a credit item from cart
     */
    private function processCartCredit(array $item, object $session, Business $business, $vendorId, $businessId): void
    {
        $creditPlanId = $item['id'] ?? null;
        $credits = (int) ($item['credits'] ?? 0);
        $quantity = (int) ($item['quantity'] ?? 1);
        $price = (float) ($item['price'] ?? 0);

        if (!$creditPlanId || $credits <= 0 || $quantity <= 0) {
            Log::warning('[Webhook] Invalid credit item data', [
                'item' => $item,
                'session_id' => $session->id,
            ]);
            return;
        }

        $totalCredits = $credits * $quantity;
        $totalPrice = $price * $quantity;

        // Add credits to business
        $business->increment('ad_credits', $totalCredits);

        // Record credit transaction
        CreditsTransaction::create([
            'business_id' => $businessId,
            'vendor_id' => $vendorId,
            'credit_plan_id' => $creditPlanId,
            'no_of_credits' => $totalCredits,
            'amount' => $totalPrice,
            'stripe_session_id' => $session->id,
            'payment_intent_id' => $session->payment_intent,
            'status' => 'completed',
            'tran_type' => 'purchase',
            'from' => now(),
            'to' => null,
        ]);

        Log::info('[Webhook] Cart credit processed', [
            'session_id' => $session->id,
            'credit_plan_id' => $creditPlanId,
            'total_credits' => $totalCredits,
        ]);
    }

    /**
     * Process a plan item from cart
     */
    private function processCartPlan(array $item, object $session, Business $business, $businessId): void
    {
        $planId = $item['id'] ?? null;
        $cycle = $item['cycle'] ?? 'quarterly';
        $price = (float) ($item['price'] ?? 0);

        if (!$planId || $price <= 0) {
            Log::warning('[Webhook] Invalid plan item data', [
                'item' => $item,
                'session_id' => $session->id,
            ]);
            return;
        }

        $plan = \App\Models\Subscription\Plan::find($planId);
        if (!$plan) {
            Log::warning("[Webhook] Plan {$planId} not found for cart");
            return;
        }

        // Calculate end date
        $endDate = match ($cycle) {
            'monthly' => now()->addMonth(),
            'quarterly' => now()->addQuarter(),
            'annually' => now()->addYear(),
            default => now()->addMonth(),
        };

        // Create subscription
        Subscription::create([
            'business_id' => $businessId,
            'plan_id' => $planId,
            'start_date' => now(),
            'end_date' => $endDate,
            'subscription_type' => $cycle === 'annually' ? 'yearly' : $cycle,
            'amount' => $price,
            'status' => 'active',
        ]);

        // Create plan transaction
        PlanTransaction::create([
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

        Log::info('[Webhook] Cart plan processed', [
            'session_id' => $session->id,
            'plan_id' => $planId,
            'cycle' => $cycle,
        ]);
    }

    private function handleCheckoutExpired(object $session): void
    {
        Log::info('[Webhook] Session expired: ' . $session->id);

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
    }
}
