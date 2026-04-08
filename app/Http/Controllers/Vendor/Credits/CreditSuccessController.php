<?php

namespace App\Http\Controllers\Vendor\Credits;

use App\Http\Controllers\Controller;
use App\Models\Subscription\CreditsTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class CreditSuccessController extends Controller
{
    public function handle(Request $request)
    {
        $sessionId = $request->query('session_id');
        if (!$sessionId) {
            return redirect()->route('vendor.credits')->with('error', 'Invalid session.');
        }

        // Wait a moment for webhook to process (optional)
        $maxAttempts = 5;
        $attempt = 0;
        $transaction = null;

        while ($attempt < $maxAttempts) {
            $transaction = CreditsTransaction::where('stripe_session_id', $sessionId)
                ->where('status', 'completed')
                ->first();
            if ($transaction) break;
            sleep(1); // wait 1 second between attempts
            $attempt++;
        }

        if ($transaction) {
            return redirect()->route('vendor.dashboard')
                ->with('success', "{$transaction->no_of_credits} credits added successfully!");
        }

        // Fallback: check Stripe directly
        try {
            Stripe::setApiKey(config('services.stripe.secret'));
            $session = Session::retrieve($sessionId);
            if ($session->payment_status === 'paid') {
                return redirect()->route('vendor.dashboard')
                    ->with('info', 'Payment received. Credits will appear shortly.');
            }
        } catch (\Exception $e) {
            Log::warning('Stripe session retrieval failed: ' . $e->getMessage());
        }

        return redirect()->route('vendor.credits')
            ->with('warning', 'Payment successful but credits are being processed. Check back in a few minutes.');
    }
}
