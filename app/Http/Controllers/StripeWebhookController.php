<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Webhook;
use Stripe\Stripe;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Subscription\CreditsTransaction;
use App\Models\Business\Business;

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
        // Only handle credit purchases
        if (empty($session->metadata->credit_plan_id)) {
            Log::info('[Webhook] No credit_plan_id in metadata — skipping.');
            return;
        }

        $businessId   = $session->metadata->business_id   ?? null;
        $creditPlanId = $session->metadata->credit_plan_id;
        $credits      = (int) ($session->metadata->credits ?? 0);
        $amount       = $session->amount_total / 100;

        if (! $businessId || $credits <= 0) {
            Log::error('[Webhook] Missing business_id or credits', [
                'session_id' => $session->id,
                'metadata'   => (array) $session->metadata,
            ]);
            return;
        }

        // Idempotency — skip if already processed
        if (CreditsTransaction::where('stripe_session_id', $session->id)->exists()) {
            Log::info('[Webhook] Session already processed: ' . $session->id);
            return;
        }

        $business = Business::find($businessId);

        if (! $business) {
            Log::error("[Webhook] Business {$businessId} not found for session {$session->id}");
            return;
        }

        // Add credits to the business
        $business->increment('ad_credits', $credits);

        // Record transaction
        CreditsTransaction::create([
            'business_id'       => $businessId,
            'credit_plan_id'    => $creditPlanId,
            'no_of_credits'     => $credits,
            'amount'            => $amount,
            'stripe_session_id' => $session->id,
            'payment_intent_id' => $session->payment_intent,
            'status'            => 'completed',
            'tran_type'         => 'purchase',
            'from'              => now(),
            'to'                => null,
        ]);

        Log::info("[Webhook] {$credits} credits added to business {$businessId}.");
    }

    private function handleCheckoutExpired(object $session): void
    {
        if (empty($session->metadata->credit_plan_id)) {
            return;
        }

        CreditsTransaction::where('stripe_session_id', $session->id)
            ->where('status', 'pending')
            ->update(['status' => 'failed']);

        Log::info('[Webhook] Session expired: ' . $session->id);
    }
}
