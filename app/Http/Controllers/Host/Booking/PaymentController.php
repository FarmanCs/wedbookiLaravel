<?php

namespace App\Http\Controllers\Host\Booking;

use App\Http\Controllers\Controller;
use App\Models\Booking\Booking;
use App\Models\Booking\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;

class PaymentController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Create Stripe Checkout Session for booking payment
     */
    public function createCheckoutSession(Booking $booking, string $paymentType = 'advance')
    {
        try {
            // Verify booking belongs to logged-in host
            if ($booking->host_id !== Auth::guard('host')->id()) {
                return redirect()->route('host.bookings.index')
                    ->with('error', 'Unauthorized access to booking.');
            }

            // Check if booking can be paid
            if (!$booking->canBePaid()) {
                return redirect()->route('host.bookings.show', $booking)
                    ->with('error', 'This booking cannot be paid at this time.');
            }

            // Determine amount to pay
            $paymentType = $booking->getNextPaymentType();
            $amount = $booking->getNextPaymentAmount();

            if ($amount <= 0) {
                return redirect()->route('host.bookings.show', $booking)
                    ->with('info', 'No payment required for this booking.');
            }

            // Get business/vendor details
            $business = $booking->business;
            $vendor = $booking->vendor;
            $bookableItem = $booking->getBookableItem();

            // Create Stripe Checkout Session
            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $business ? $business->company_name : ($vendor->full_name ?? 'Event Booking'),
                            'description' => sprintf(
                                '%s - %s (%s Payment)',
                                $booking->getBookableItemName(),
                                $booking->custom_booking_id,
                                ucfirst($paymentType)
                            ),
                            'images' => $business && $business->profile_image
                                ? [asset('storage/' . $business->profile_image)]
                                : [],
                        ],
                        'unit_amount' => (int)($amount * 100), // Convert to cents
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('host.bookings.payment.success', [
                    'booking' => $booking->id
                ]) . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('host.bookings.payment.cancel') . '?booking_id=' . $booking->id,
                'client_reference_id' => $booking->id,
                'customer_email' => Auth::guard('host')->user()->email,
                'metadata' => [
                    'booking_id' => $booking->id,
                    'host_id' => $booking->host_id,
                    'vendor_id' => $booking->vendor_id,
                    'payment_type' => $paymentType,
                    'custom_booking_id' => $booking->custom_booking_id,
                    'event_date' => $booking->event_date->format('Y-m-d'),
                ],
            ]);

            // Store session ID in booking
            if ($paymentType === 'advance') {
                $booking->stripe_advance_session_id = $session->id;
            } else {
                $booking->stripe_final_session_id = $session->id;
            }
            $booking->save();

            // Create pending transaction record
            Transaction::create([
                'booking_id' => $booking->id,
                'host_id' => $booking->host_id,
                'vendor_id' => $booking->vendor_id,
                'amount' => $amount,
                'status' => 'pending',
                'payment_method' => 'stripe',
                'payment_type' => $paymentType,
                'stripe_session_id' => $session->id,
                'sender_id' => $booking->host_id,
                'receiver_id' => $booking->vendor_id,
                'sender_type' => 'host',
                'receiver_type' => 'vendor',
                'sender_name' => Auth::guard('host')->user()->full_name,
                'receiver_name' => $vendor->full_name ?? 'Vendor',
                'metadata' => [
                    'booking_type' => $booking->booking_type,
                    'bookable_item' => $booking->getBookableItemName(),
                ],
            ]);

            // Redirect to Stripe Checkout
            return redirect($session->url);
        } catch (\Exception $e) {
            Log::error('Stripe Checkout Session Error: ' . $e->getMessage(), [
                'booking_id' => $booking->id,
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('host.bookings.show', $booking)
                ->with('error', 'Unable to process payment. Please try again later.');
        }
    }

    /**
     * Handle successful payment callback
     */
    public function success(Request $request, Booking $booking)
    {
        $sessionId = $request->get('session_id');

        if (!$sessionId) {
            return redirect()->route('host.bookings.show', $booking)
                ->with('warning', 'Payment session not found.');
        }

        try {
            // Retrieve the session from Stripe
            $session = StripeSession::retrieve($sessionId);

            // Verify payment was successful
            if ($session->payment_status === 'paid') {
                return redirect()->route('host.bookings.show', $booking)
                    ->with('success', 'Payment successful! Your booking has been updated.');
            } else {
                return redirect()->route('host.bookings.show', $booking)
                    ->with('warning', 'Payment is being processed. We will update your booking shortly.');
            }
        } catch (\Exception $e) {
            Log::error('Payment Success Callback Error: ' . $e->getMessage());

            return redirect()->route('host.bookings.show', $booking)
                ->with('info', 'Payment received. Your booking will be updated shortly.');
        }
    }

    /**
     * Handle cancelled payment callback
     */
    public function cancel(Request $request)
    {
        $bookingId = $request->get('booking_id');

        if ($bookingId) {
            return redirect()->route('host.bookings.show', $bookingId)
                ->with('error', 'Payment was cancelled. You can try again when ready.');
        }

        return redirect()->route('host.bookings.index')
            ->with('error', 'Payment was cancelled.');
    }

    /**
     * Handle Stripe Webhook Events
     */
    public function webhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $webhookSecret = config('services.stripe.webhook_secret');

        try {
            // Verify webhook signature
            $event = Webhook::constructEvent($payload, $sigHeader, $webhookSecret);
        } catch (\UnexpectedValueException $e) {
            Log::error('Stripe Webhook - Invalid payload: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (SignatureVerificationException $e) {
            Log::error('Stripe Webhook - Invalid signature: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Handle the event
        try {
            switch ($event->type) {
                case 'checkout.session.completed':
                    $this->handleCheckoutSessionCompleted($event->data->object);
                    break;

                case 'payment_intent.succeeded':
                    $this->handlePaymentIntentSucceeded($event->data->object);
                    break;

                case 'payment_intent.payment_failed':
                    $this->handlePaymentIntentFailed($event->data->object);
                    break;

                case 'charge.refunded':
                    $this->handleChargeRefunded($event->data->object);
                    break;

                default:
                    Log::info('Unhandled Stripe webhook event: ' . $event->type);
            }

            return response()->json(['status' => 'success'], 200);
        } catch (\Exception $e) {
            Log::error('Stripe Webhook Handler Error: ' . $e->getMessage(), [
                'event_type' => $event->type,
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(['error' => 'Webhook handler failed'], 500);
        }
    }

    /**
     * Handle checkout.session.completed event
     */
    protected function handleCheckoutSessionCompleted($session)
    {
        $bookingId = $session->metadata->booking_id ?? $session->client_reference_id;
        $paymentType = $session->metadata->payment_type ?? 'advance';

        if (!$bookingId) {
            Log::warning('Stripe Webhook - No booking ID in session metadata', [
                'session_id' => $session->id,
            ]);
            return;
        }

        $booking = Booking::find($bookingId);

        if (!$booking) {
            Log::error('Stripe Webhook - Booking not found', [
                'booking_id' => $bookingId,
                'session_id' => $session->id,
            ]);
            return;
        }

        // Update booking payment status
        if ($paymentType === 'advance') {
            $booking->advance_paid = true;
            $booking->stripe_advance_payment_intent = $session->payment_intent;
        } else {
            $booking->final_paid = true;
            $booking->stripe_final_payment_intent = $session->payment_intent;
        }

        $booking->updatePaymentStatus();

        // Update transaction status
        Transaction::where('booking_id', $booking->id)
            ->where('stripe_session_id', $session->id)
            ->update([
                'status' => 'completed',
                'stripe_payment_intent_id' => $session->payment_intent,
                'paid_at' => now(),
                'click_pay_response' => $session->toArray(),
            ]);

        Log::info('Booking payment completed', [
            'booking_id' => $booking->id,
            'custom_booking_id' => $booking->custom_booking_id,
            'payment_type' => $paymentType,
            'session_id' => $session->id,
        ]);

        // TODO: Send email notifications
        // dispatch(new SendPaymentConfirmationEmail($booking, $paymentType));
        // dispatch(new SendVendorPaymentNotification($booking, $paymentType));
    }

    /**
     * Handle payment_intent.succeeded event
     */
    protected function handlePaymentIntentSucceeded($paymentIntent)
    {
        Log::info('Payment Intent Succeeded', [
            'payment_intent_id' => $paymentIntent->id,
            'amount' => $paymentIntent->amount / 100,
        ]);

        // Additional processing if needed
    }

    /**
     * Handle payment_intent.payment_failed event
     */
    protected function handlePaymentIntentFailed($paymentIntent)
    {
        Log::error('Payment Intent Failed', [
            'payment_intent_id' => $paymentIntent->id,
            'failure_message' => $paymentIntent->last_payment_error->message ?? 'Unknown error',
        ]);

        // Update transaction status to failed
        Transaction::where('stripe_payment_intent_id', $paymentIntent->id)
            ->update([
                'status' => 'failed',
                'comments' => $paymentIntent->last_payment_error->message ?? 'Payment failed',
            ]);

        // TODO: Send failure notification
    }

    /**
     * Handle charge.refunded event
     */
    protected function handleChargeRefunded($charge)
    {
        Log::info('Charge Refunded', [
            'charge_id' => $charge->id,
            'amount_refunded' => $charge->amount_refunded / 100,
        ]);

        // Find and update transaction
        $transaction = Transaction::where('stripe_payment_intent_id', $charge->payment_intent)->first();

        if ($transaction) {
            $transaction->update([
                'status' => 'refunded',
                'comments' => 'Payment refunded',
            ]);

            // Update booking status
            $booking = $transaction->booking;
            if ($booking) {
                if ($transaction->payment_type === 'advance') {
                    $booking->advance_paid = false;
                } else {
                    $booking->final_paid = false;
                }
                $booking->updatePaymentStatus();
            }
        }
    }
}
