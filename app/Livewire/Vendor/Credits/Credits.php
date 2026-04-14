<?php

namespace App\Livewire\Vendor\Credits;

use App\Models\Subscription\CreditPlan;
use App\Models\Subscription\CreditsTransaction;
use App\Models\Business\Business;
use App\Models\Vendor\VendorPurchase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Stripe\Checkout\Session;
use Stripe\Stripe;

#[Layout('components.layouts.vendor.vendor')]
class Credits extends Component
{
    public $availablePlans = [];          // Plans not yet purchased for the selected business
    public $transactions = [];
    public $businesses = [];
    public $selectedPlan = null;
    public $selectedPurchaseBusinessId = null;  // Business for which we buy credits
    public $purchasedTabBusinessFilter = null;  // Business filter on purchased tab (null = all)
    public bool $showModal = false;
    public bool $processing = false;
    public string $activeTab = 'purchased';

    public function mount(): void
    {
        $vendor = Auth::guard('vendor')->user();
        $this->businesses = $vendor->businesses()->select('id', 'company_name')->get();

        // Default to first business if any
        if ($this->businesses->isNotEmpty()) {
            $this->selectedPurchaseBusinessId = $this->businesses->first()->id;
            $this->purchasedTabBusinessFilter = null; // show all by default
        }

        $this->loadHistory();
        $this->loadAvailablePlans();
    }

    public function loadHistory(): void
    {
        $vendor = Auth::guard('vendor')->user();
        $businessIds = $vendor->businesses()->pluck('id');

        $query = CreditsTransaction::whereIn('business_id', $businessIds)
            ->with('business', 'creditPlan')
            ->orderByDesc('created_at');

        if ($this->purchasedTabBusinessFilter) {
            $query->where('business_id', $this->purchasedTabBusinessFilter);
        }

        $this->transactions = $query->get();
    }

    public function loadAvailablePlans(): void
    {
        if (!$this->selectedPurchaseBusinessId) {
            $this->availablePlans = collect();
            return;
        }

        // Get all credit plans
        $allPlans = CreditPlan::orderBy('price')->get();

        // Find plans already purchased (completed) for this specific business
        $purchasedPlanIds = CreditsTransaction::where('business_id', $this->selectedPurchaseBusinessId)
            ->where('status', 'completed')
            ->pluck('credit_plan_id')
            ->unique()
            ->toArray();

        $this->availablePlans = $allPlans->filter(
            fn($plan) => !in_array($plan->id, $purchasedPlanIds)
        )->values();
    }

    public function updatedSelectedPurchaseBusinessId(): void
    {
        $this->loadAvailablePlans();
    }

    public function updatedPurchasedTabBusinessFilter(): void
    {
        $this->loadHistory();
    }

    public function selectPlan(int $planId): void
    {
        $this->selectedPlan = CreditPlan::find($planId);
        $this->showModal = true;
        $this->processing = false;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->selectedPlan = null;
        $this->processing = false;
    }

    public function purchase(): void
    {
        $this->validate([
            'selectedPurchaseBusinessId' => 'required|exists:businesses,id',
        ], [
            'selectedPurchaseBusinessId.required' => 'Please select a business to assign credits.',
        ]);

        $vendor = Auth::guard('vendor')->user();
        $business = Business::where('id', $this->selectedPurchaseBusinessId)
            ->where('vendor_id', $vendor->id)
            ->first();

        if (!$business) {
            $this->addError('selectedPurchaseBusinessId', 'Business not found.');
            return;
        }

        $plan = $this->selectedPlan;
        if (!$plan) {
            session()->flash('error', 'No plan selected.');
            $this->closeModal();
            return;
        }

        // Double-check that this business hasn't already purchased this plan (completed)
        $alreadyPurchased = CreditsTransaction::where('business_id', $business->id)
            ->where('credit_plan_id', $plan->id)
            ->where('status', 'completed')
            ->exists();

        if ($alreadyPurchased) {
            session()->flash('error', 'This business already purchased this credit plan.');
            $this->closeModal();
            return;
        }

        $finalPrice = round((float)$plan->price, 2);
        if ($plan->discounted_percentage > 0) {
            $finalPrice = round($finalPrice * (100 - $plan->discounted_percentage) / 100, 2);
        }

        if ($finalPrice <= 0) {
            session()->flash('error', 'Invalid price.');
            $this->closeModal();
            return;
        }

        $stripeSecret = config('services.stripe.secret');
        if (empty($stripeSecret)) {
            session()->flash('error', 'Payment gateway not configured.');
            $this->closeModal();
            return;
        }

        $this->processing = true;

        try {
            Stripe::setApiKey($stripeSecret);

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => config('services.stripe.currency', 'usd'),
                        'product_data' => [
                            'name' => $plan->name . ' — ' . $plan->no_of_credits . ' Ad Credits',
                            'description' => $plan->description ?? 'Ad credits for your business',
                        ],
                        'unit_amount' => (int)round($finalPrice * 100),
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('vendor.credits.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('vendor.credits'),
                'metadata' => [
                    'vendor_id' => (string)$vendor->id,
                    'business_id' => (string)$business->id,
                    'credit_plan_id' => (string)$plan->id,
                    'credits' => (string)$plan->no_of_credits,
                ],
            ]);

            VendorPurchase::updateOrCreate(
                ['stripe_session_id' => $session->id],
                [
                    'vendor_id' => $vendor->id,
                    'business_id' => $business->id,
                    'cart_items' => json_encode([
                        [
                            'type' => 'credit',
                            'id' => $plan->id,
                            'name' => $plan->name,
                            'credits' => $plan->no_of_credits,
                            'price' => $finalPrice,
                            'quantity' => 1,
                        ],
                    ]),
                    'total_amount' => $finalPrice,
                    'payment_intent_id' => null,
                    'status' => 'pending',
                ]
            );

            $this->dispatch('stripe-redirect', url: $session->url);
        } catch (\Exception $e) {
            Log::error('[Credits] Stripe error: ' . $e->getMessage());
            session()->flash('error', 'Payment error: ' . $e->getMessage());
            $this->closeModal();
        }
    }

    public function render()
    {
        $vendor = Auth::guard('vendor')->user();
        $totalCredits = $vendor->credits ?? 0;

        return view('livewire.vendor.credits.credits', [
            'totalCredits' => $totalCredits,
            'vendor' => $vendor,
        ]);
    }
}
