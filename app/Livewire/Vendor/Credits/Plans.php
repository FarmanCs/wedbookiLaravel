<?php

namespace App\Livewire\Vendor\Credits;

use App\Models\Subscription\Plan;
use App\Models\Subscription\CreditPlan;
use App\Models\Subscription\CreditsTransaction;
use App\Models\Subscription\PlanTransaction;
use App\Models\Subscription\Subscription;
use App\Models\Business\Business;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.vendor.vendor')]
class Plans extends Component
{
    // Subscription plans data
    public $plans = [];
    public $selectedPlan = null;
    public $selectedCycle = null;
    public $selectedPrice = null;
    public $showPlanConfirmModal = false;
    public $businesses = [];
    public $selectedBusinessId = null;

    // Ad credits data
    public $creditPlans = [];
    public $selectedCreditPlan = null;
    public $showCreditConfirmModal = false;

    public function mount()
    {
        $this->loadBusinesses();
        $this->loadSubscriptionPlans();
        $this->loadCreditPlans();
    }

    public function loadBusinesses()
    {
        $vendor = Auth::guard('vendor')->user();
        $this->businesses = $vendor->businesses()->select('id', 'company_name')->get();
    }

    public function loadSubscriptionPlans()
    {
        $this->plans = Plan::with('features')->orderBy('monthly_price')->get();
    }

    public function loadCreditPlans()
    {
        $this->creditPlans = CreditPlan::orderBy('price')->get();
    }

    public function buyPlan($planId, $cycle)
    {
        $plan = Plan::find($planId);
        if (!$plan) {
            session()->flash('error', 'Plan not found.');
            return;
        }

        // Calculate final price based on cycle
        $basePrice = match ($cycle) {
            'monthly' => $plan->monthly_price,
            'quarterly' => $plan->quarterly_price,
            'annually' => $plan->yearly_price,
            default => $plan->quarterly_price,
        };

        $discountPercent = match ($cycle) {
            'quarterly' => 5,
            'annually' => 10,
            default => 0,
        };

        $finalPrice = $discountPercent > 0
            ? $basePrice * (100 - $discountPercent) / 100
            : $basePrice;

        // Store data for the confirmation modal
        $this->selectedPlan = $plan;
        $this->selectedCycle = $cycle;
        $this->selectedPrice = $finalPrice;

        // Auto-select first business if exists
        if ($this->businesses->isNotEmpty()) {
            $this->selectedBusinessId = $this->businesses->first()->id;
        } else {
            $this->selectedBusinessId = null;
        }

        $this->showPlanConfirmModal = true;
    }

    public function cancelPlanConfirm()
    {
        $this->showPlanConfirmModal = false;
        $this->selectedPlan = null;
        $this->selectedCycle = null;
        $this->selectedPrice = null;
        $this->selectedBusinessId = null;
    }

    public function confirmPlanPurchase()
    {
        $vendor = Auth::guard('vendor')->user();

        if (!$this->selectedPlan) {
            session()->flash('error', 'No plan selected.');
            $this->cancelPlanConfirm();
            return;
        }

        if (!$this->selectedBusinessId) {
            session()->flash('error', 'Please select a business for this subscription.');
            return;
        }

        $business = Business::where('id', $this->selectedBusinessId)
            ->where('vendor_id', $vendor->id)
            ->first();

        if (!$business) {
            session()->flash('error', 'Selected business not found or does not belong to you.');
            return;
        }

        // Create subscription
        Subscription::create([
            'business_id' => $business->id,
            'plan_id' => $this->selectedPlan->id,
            'start_date' => now(),
            'end_date' => match ($this->selectedCycle) {
                'monthly' => now()->addMonth(),
                'quarterly' => now()->addQuarter(),
                'annually' => now()->addYear(),
                default => now()->addMonth(),
            },
            'subscription_type' => match ($this->selectedCycle) {
                'monthly' => 'monthly',
                'quarterly' => 'quarterly',
                'annually' => 'yearly', // corrected to match enum
                default => 'monthly',
            },
            'amount' => $this->selectedPrice,
            'status' => 'active',
        ]);

        // Record transaction
        PlanTransaction::create([
            'business_id' => $business->id,
            'plan_id' => $this->selectedPlan->id,
            'tran_time' => now(),
            'from' => 'vendor',
            'to' => 'platform',
            'amount' => $this->selectedPrice,
            'tran_type' => 'purchase', // <-- must be one of the enum values: 'purchase' or 'renewal'
        ]);

        session()->flash('success', "Successfully subscribed to {$this->selectedPlan->name} ({$this->selectedCycle}) plan for business {$business->company_name}!");

        $this->cancelPlanConfirm();
        $this->loadSubscriptionPlans();
    }

    // ==================== AD CREDITS ====================

    public function buyCreditPlan($planId)
    {
        $plan = CreditPlan::find($planId);
        if (!$plan) {
            session()->flash('error', 'Ad credits plan not found.');
            return;
        }

        $this->selectedCreditPlan = $plan;
        $this->showCreditConfirmModal = true;
    }

    public function cancelCreditConfirm()
    {
        $this->showCreditConfirmModal = false;
        $this->selectedCreditPlan = null;
    }

    public function confirmCreditPurchase()
    {
        $vendor = Auth::guard('vendor')->user();

        if (!$this->selectedCreditPlan) {
            session()->flash('error', 'No ad credits plan selected.');
            $this->cancelCreditConfirm();
            return;
        }

        // Apply discount if any
        $finalPrice = $this->selectedCreditPlan->price;
        if ($this->selectedCreditPlan->discounted_percentage) {
            $finalPrice = $this->selectedCreditPlan->price * (100 - $this->selectedCreditPlan->discounted_percentage) / 100;
        }

        // Add credits to vendor
        $vendor->credits += $this->selectedCreditPlan->no_of_credits;
        $vendor->save();

        // Record transaction – FIXED: use CreditsTransaction, not PlanTransaction
        CreditsTransaction::create([
            'business_id' => null, // vendor‑wide credits
            'no_of_credits' => $this->selectedCreditPlan->no_of_credits,
            'amount' => $finalPrice,
            'from' => 'purchase',
            'to' => 'vendor',
            'tran_type' => 'credits', // short enough
        ]);

        session()->flash('success', "Successfully purchased {$this->selectedCreditPlan->no_of_credits} credits!");

        $this->cancelCreditConfirm();
        $this->loadCreditPlans(); // optional refresh
    }

    public function render()
    {
        return view('livewire.vendor.credits.plans', [
            'plans' => $this->plans,
            'creditPlans' => $this->creditPlans,
        ]);
    }
}
