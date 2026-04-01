<?php

namespace App\Livewire\Vendor\Plan;

use App\Models\Subscription\Plan;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.host.host')]

class WeddingPlanner extends Component
{
    public $plans;
    public $darkMode = false;


    public function mount()
    {
        // Load plans with all related data using eager loading
        $this->plans = Plan::with([
            'features',           // Get all features related to this plan
            'subscriptions',      // Get all subscriptions for this plan
            'transactions',       // Get all transactions for this plan
            'category'            // Get the category relationship
        ])
            ->where('is_active', true)
            ->orderBy('monthly_price', 'asc')
            ->get()
            ->map(function ($plan) {
                // Add custom attributes for statistics
                $plan->subscriptions_count = $plan->subscriptions->count();
                $plan->transactions_count = $plan->transactions->count();
                return $plan;
            });
    }

    /**
     * Toggle dark mode state
     */
    public function toggleDarkMode()
    {
        $this->darkMode = !$this->darkMode;
        // Optionally, you can store this preference in the session or database
        // session(['vendor_dark_mode' => $this->darkMode]);
    }

    /**
     * Select a plan - can be extended with subscription logic
     */
    public function selectPlan($planId)
    {
        $plan = Plan::findOrFail($planId);

        // You can emit an event, dispatch a modal, or redirect
        // Example: redirect to subscription page
        return redirect()->route('vendor.plans.subscribe', ['plan' => $plan->id]);
    }

    /**
     * Get statistics for a specific plan
     */
    public function getPlanStats($planId)
    {
        $plan = $this->plans->find($planId);

        if (!$plan) {
            return [];
        }

        return [
            'active_subscriptions' => $plan->subscriptions()
                ->where('status', 'active')
                ->count(),
            'total_revenue' => $plan->transactions()
                ->sum('amount'),
            'avg_subscription_value' => $plan->subscriptions()
                ->where('status', 'active')
                ->avg('amount') ?? 0,
        ];
    }

    /**
     * Filter plans by category
     */
    public function filterByCategory($categoryId)
    {
        if ($categoryId) {
            $this->plans = Plan::with(['features', 'subscriptions', 'transactions', 'category'])
                ->where('is_active', true)
                ->where('category_id', $categoryId)
                ->orderBy('monthly_price', 'asc')
                ->get();
        } else {
            $this->mount();
        }
    }

    public function render()
    {
        return view('livewire.vendor.plan.wedding-planner', [
            'plans' => $this->plans,
        ]);
    }
}
