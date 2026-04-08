<?php

namespace App\Livewire\Vendor\Credits;

use App\Models\Subscription\Plan;
use App\Models\Subscription\CreditPlan;
use App\Models\Subscription\PlanTransaction;
use App\Models\Subscription\Subscription;
use App\Models\Business\Business;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Stripe\Checkout\Session;
use Stripe\Stripe;

#[Layout('components.layouts.vendor.vendor')]
class Plans extends Component
{
    // ── Subscription plan state ───────────────────────────────────────────────
    public $plans           = [];
    public $selectedPlan    = null;
    public $selectedCycle   = null;
    public $selectedPrice   = null;
    public bool $showPlanConfirmModal = false;
    public $selectedBusinessId        = null;

    // ── Ad credits state ──────────────────────────────────────────────────────
    public $creditPlans                  = [];
    public $selectedCreditPlan           = null;
    public bool $showCreditConfirmModal  = false;
    public $selectedBusinessIdForCredits = null;
    public bool $processingPayment       = false;

    // ── Shared ────────────────────────────────────────────────────────────────
    public $businesses = [];

    public function mount(): void
    {
        $this->loadBusinesses();
        $this->loadSubscriptionPlans();
        $this->loadCreditPlans();
    }

    public function loadBusinesses(): void
    {
        $vendor = Auth::guard('vendor')->user();
        $this->businesses = $vendor->businesses()->select('id', 'company_name')->get();
    }

    public function loadSubscriptionPlans(): void
    {
        $this->plans = Plan::with('features')->orderBy('monthly_price')->get();
    }

    public function loadCreditPlans(): void
    {
        $this->creditPlans = CreditPlan::orderBy('price')->get();
    }

    // ── Subscription plan flow ────────────────────────────────────────────────

    public function buyPlan(int $planId, string $cycle): void
    {
        $plan = Plan::find($planId);

        if (! $plan) {
            session()->flash('error', 'Plan not found.');
            return;
        }

        $basePrice = match ($cycle) {
            'monthly'   => $plan->monthly_price,
            'quarterly' => $plan->quarterly_price,
            'annually'  => $plan->yearly_price,
            default     => $plan->quarterly_price,
        };

        $discountPercent = match ($cycle) {
            'quarterly' => 5,
            'annually'  => 10,
            default     => 0,
        };

        $this->selectedPlan  = $plan;
        $this->selectedCycle = $cycle;
        $this->selectedPrice = $discountPercent > 0
            ? $basePrice * (100 - $discountPercent) / 100
            : $basePrice;

        $this->selectedBusinessId = $this->businesses->isNotEmpty()
            ? $this->businesses->first()->id
            : null;

        $this->showPlanConfirmModal = true;
    }

    public function cancelPlanConfirm(): void
    {
        $this->showPlanConfirmModal = false;
        $this->selectedPlan         = null;
        $this->selectedCycle        = null;
        $this->selectedPrice        = null;
        $this->selectedBusinessId   = null;
    }

    public function confirmPlanPurchase(): void
    {
        $vendor = Auth::guard('vendor')->user();

        $this->validate(['selectedBusinessId' => 'required|exists:businesses,id']);

        $business = Business::where('id', $this->selectedBusinessId)
            ->where('vendor_id', $vendor->id)
            ->firstOrFail();

        Subscription::create([
            'business_id'       => $business->id,
            'plan_id'           => $this->selectedPlan->id,
            'start_date'        => now(),
            'end_date'          => $this->resolveEndDate($this->selectedCycle),
            'subscription_type' => $this->selectedCycle === 'annually' ? 'yearly' : $this->selectedCycle,
            'amount'            => $this->selectedPrice,
            'status'            => 'active',
        ]);

        PlanTransaction::create([
            'business_id'      => $business->id,
            'plan_id'          => $this->selectedPlan->id,
            'transaction_time' => now(),
            'start_at'         => now(),
            'end_at'           => $this->resolveEndDate($this->selectedCycle),
            'amount'           => $this->selectedPrice,
            'transaction_type' => 'purchase',
        ]);

        session()->flash('success', "Subscribed to {$this->selectedPlan->name} ({$this->selectedCycle}) for {$business->company_name}!");
        $this->cancelPlanConfirm();
        $this->loadSubscriptionPlans();
    }

    private function resolveEndDate(string $cycle): \Carbon\Carbon
    {
        return match ($cycle) {
            'monthly'   => now()->addMonth(),
            'quarterly' => now()->addQuarter(),
            'annually'  => now()->addYear(),
            default     => now()->addMonth(),
        };
    }

    // ── Ad credits flow ───────────────────────────────────────────────────────

    public function buyCreditPlan(int $planId): void
    {
        $plan = CreditPlan::find($planId);

        if (! $plan) {
            session()->flash('error', 'Ad credits plan not found.');
            return;
        }

        $this->selectedCreditPlan = $plan;

        $this->selectedBusinessIdForCredits = $this->businesses->isNotEmpty()
            ? $this->businesses->first()->id
            : null;

        $this->showCreditConfirmModal = true;
        $this->processingPayment      = false;
    }

    public function cancelCreditConfirm(): void
    {
        $this->showCreditConfirmModal       = false;
        $this->selectedCreditPlan           = null;
        $this->selectedBusinessIdForCredits = null;
        $this->processingPayment            = false;
    }

    public function confirmCreditPurchase(): void
    {
        $this->validate([
            'selectedBusinessIdForCredits' => 'required|integer',
        ], [
            'selectedBusinessIdForCredits.required' => 'Please select a business.',
        ]);

        $vendor = Auth::guard('vendor')->user();

        $business = Business::where('id', $this->selectedBusinessIdForCredits)
            ->where('vendor_id', $vendor->id)
            ->first();

        if (! $business) {
            $this->addError('selectedBusinessIdForCredits', 'Business not found or does not belong to you.');
            return;
        }

        $plan = $this->selectedCreditPlan;

        if (! $plan) {
            session()->flash('error', 'No credit plan selected. Please try again.');
            $this->cancelCreditConfirm();
            return;
        }

        $finalPrice = round((float) $plan->price, 2);
        if ($plan->discounted_percentage > 0) {
            $finalPrice = round($finalPrice * (100 - $plan->discounted_percentage) / 100, 2);
        }

        if ($finalPrice <= 0) {
            session()->flash('error', 'Invalid price for this plan.');
            $this->cancelCreditConfirm();
            return;
        }

        $stripeSecret = config('services.stripe.secret');

        if (empty($stripeSecret)) {
            Log::error('[Stripe] Secret key is empty. Run: php artisan config:clear');
            session()->flash('error', 'Payment gateway is not configured. Contact support.');
            $this->cancelCreditConfirm();
            return;
        }

        $this->processingPayment = true;

        try {
            Stripe::setApiKey($stripeSecret);

            $unitAmountCents = (int) round($finalPrice * 100);

            Log::info('[Stripe] Creating checkout session', [
                'vendor_id'   => $vendor->id,
                'business_id' => $business->id,
                'plan_id'     => $plan->id,
                'credits'     => $plan->no_of_credits,
                'cents'       => $unitAmountCents,
            ]);

            // ✅ Use route() directly — it returns an absolute URL already.
            $successUrl = route('vendor.credits.success') . '?session_id={CHECKOUT_SESSION_ID}';
            $cancelUrl  = route('vendor.credits');

            // Log::info('[Stripe] success_url: ' . $successUrl);
            // Log::info('[Stripe] cancel_url: '  . $cancelUrl);

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency'     => config('services.stripe.currency', 'usd'),
                        'product_data' => [
                            'name'        => $plan->name . ' — ' . $plan->no_of_credits . ' Ad Credits',
                            'description' => $plan->description ?? 'Ad credits for your business',
                        ],
                        'unit_amount' => $unitAmountCents,
                    ],
                    'quantity' => 1,
                ]],
                'mode'        => 'payment',
                'success_url' => $successUrl,
                'cancel_url'  => $cancelUrl,
                'metadata'    => [
                    'vendor_id'      => (string) $vendor->id,
                    'business_id'    => (string) $business->id,
                    'credit_plan_id' => (string) $plan->id,
                    'credits'        => (string) $plan->no_of_credits,
                ],
            ]);

            Log::info('[Stripe] Session created: ' . $session->id);

            // Dispatch Alpine event to trigger window.location.href = stripe URL
            $this->dispatch('stripe-redirect', url: $session->url);
        } catch (\Stripe\Exception\AuthenticationException $e) {
            Log::error('[Stripe] Auth failed — wrong STRIPE_SECRET_KEY: ' . $e->getMessage());
            session()->flash('error', 'Payment authentication failed. Contact support.');
            $this->cancelCreditConfirm();
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            Log::error('[Stripe] Invalid request: ' . $e->getMessage(), ['body' => $e->getJsonBody()]);
            session()->flash('error', 'Invalid payment request: ' . $e->getMessage());
            $this->cancelCreditConfirm();
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            Log::error('[Stripe] Network error: ' . $e->getMessage());
            session()->flash('error', 'Could not connect to payment gateway. Please try again.');
            $this->cancelCreditConfirm();
        } catch (\Stripe\Exception\ApiErrorException $e) {
            Log::error('[Stripe] API error: ' . $e->getMessage(), ['body' => $e->getJsonBody()]);
            session()->flash('error', 'Payment error: ' . $e->getMessage());
            $this->cancelCreditConfirm();
        } catch (\Exception $e) {
            Log::error('[Stripe] Unexpected: ' . $e->getMessage(), [
                'class' => get_class($e),
                'file'  => $e->getFile() . ':' . $e->getLine(),
            ]);
            session()->flash('error', 'Unexpected error: ' . $e->getMessage());
            $this->cancelCreditConfirm();
        }
    }

    public function render()
    {
        return view('livewire.vendor.credits.plans', [
            'plans'       => $this->plans,
            'creditPlans' => $this->creditPlans,
        ]);
    }
}
