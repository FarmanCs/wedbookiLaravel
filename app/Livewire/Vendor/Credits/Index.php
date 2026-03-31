<?php

namespace App\Livewire\Vendor\Credits;

use App\Models\Subscription\CreditPlan;
use App\Models\Subscription\CreditsTransaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $creditPlans = [];
    public $selectedPlan = null;
    public $showConfirmModal = false;
    public $showPurchaseModal = true; // controls visibility of the plan selection modal

    protected $listeners = ['openCreditPlans' => 'openModal'];

    public function mount()
    {
        $this->loadCreditPlans();
    }

    public function loadCreditPlans()
    {
        $this->creditPlans = CreditPlan::orderBy('price')->get()->toArray();
    }

    public function openModal()
    {
        $this->showPurchaseModal = true;
    }

    public function closeModal()
    {
        $this->showPurchaseModal = false;
        $this->reset(['selectedPlan', 'showConfirmModal']);
    }

    public function buyPlan($planId)
    {
        $this->selectedPlan = CreditPlan::findOrFail($planId);
        $this->showConfirmModal = true;
    }

    public function cancelConfirm()
    {
        $this->showConfirmModal = false;
        $this->selectedPlan = null;
    }

    public function confirmPurchase()
    {
        if (!$this->selectedPlan) {
            $this->dispatch('error', 'No plan selected.');
            return;
        }

        $vendor = Auth::guard('vendor')->user();
        $finalPrice = $this->selectedPlan->price; // you can apply discount here if needed

        // For simplicity, we assume vendor has enough balance? In real app, you'd process payment.
        // We'll just add credits to vendor and create transaction.
        $vendor->credits += $this->selectedPlan->no_of_credits;
        $vendor->save();

        // Create transaction record
        CreditsTransaction::create([
            'business_id' => null, // or you can link to a business if needed
            'no_of_credits' => $this->selectedPlan->no_of_credits,
            'amount' => $finalPrice,
            'from' => 'purchase',
            'to' => 'vendor',
            'tran_type' => 'credit_purchase',
        ]);

        $this->dispatch('credits-updated', $vendor->credits);
        session()->flash('success', "Successfully purchased {$this->selectedPlan->no_of_credits} credits!");

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.vendor.credits.index', [
            'plans' => $this->creditPlans,
        ]);
    }
}
