<?php

namespace App\Livewire\Vendor\Payments;

use App\Models\Booking\BankAccount;
use App\Models\Vendor\Vendor;
use App\Models\Booking\Invoice;
use App\Models\Booking\Transaction;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

#[Layout('components.layouts.vendor.vendor')]
class Index extends Component
{
    public $vendor;
    public $totalEarnings = 0;
    public $pendingToWithdraw = 0;
    public $paidAmount = 0;
    public $totalDisputeRefunded = 0;
    public $totalWaiverRefunded = 0;
    public $paymentMethod;
    public $withdrawRequests;
    public $bankAccounts;
    public $showModal = false;
    public $amount;
    public $selectedBankAccountId;
    public $showDeleteModal = false;
    public $deleteId;

    protected function getListeners()
    {
        return [
            'bankAccountSaved' => 'loadBankAccounts',
        ];
    }

    public function mount()
    {
        $this->vendor = Auth::guard('vendor')->user();
        $this->loadStats();
        $this->loadBankAccounts();
        $this->loadWithdrawRequests();
    }

    public function loadStats()
    {
        $this->totalEarnings = Invoice::where('vendor_id', $this->vendor->id)
            ->whereHas('booking', function ($query) {
                $query->whereIn('status', ['confirmed', 'completed'])
                    ->where('final_paid', true);
            })
            ->sum('vendor_share') ?? 0;

        $this->paidAmount = Transaction::where('vendor_id', $this->vendor->id)
            ->where('type', 'withdrawal')
            ->where('status', 'successful')
            ->sum('amount') ?? 0;

        $this->pendingToWithdraw = max(0, $this->totalEarnings - $this->paidAmount);
        $this->totalDisputeRefunded = 0;
        $this->totalWaiverRefunded = 0;
    }

    public function loadBankAccounts()
    {
        $this->bankAccounts = BankAccount::where('vendor_id', $this->vendor->id)
            ->orderBy('is_default', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $default = $this->bankAccounts->firstWhere('is_default', true);
        $this->paymentMethod = $default ? [
            'bank_name' => $default->bank_name,
            'bank_last4' => $default->account_last4,
            'account_holder_name' => $default->account_holder_name,
        ] : [
            'bank_name' => null,
            'bank_last4' => null,
            'account_holder_name' => null,
        ];
    }

    public function loadWithdrawRequests()
    {
        $this->withdrawRequests = Transaction::where('vendor_id', $this->vendor->id)
            ->where('type', 'withdrawal')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($transaction) {
                $metadata = $transaction->metadata ?? [];
                return (object) [
                    'id' => $transaction->id,
                    'amount' => $transaction->amount,
                    'status' => $transaction->status,
                    'requested_at' => $transaction->created_at,
                    'processed_at' => $transaction->paid_at ?? null,
                    'bank_name' => $metadata['bank_name'] ?? $this->vendor->bank_name,
                    'bank_last4' => $metadata['bank_last4'] ?? $this->vendor->bank_last4,
                    'account_holder_name' => $metadata['account_holder_name'] ?? $this->vendor->account_holder_name,
                ];
            });
    }

    public function requestWithdraw()
    {
        $this->showModal = true;
    }

    public function submitWithdrawRequest()
    {
        $this->validate([
            'amount' => 'required|numeric|min:1|max:' . $this->pendingToWithdraw,
            'selectedBankAccountId' => 'required|exists:bank_accounts,id,vendor_id,' . $this->vendor->id,
        ]);

        $account = BankAccount::find($this->selectedBankAccountId);

        DB::transaction(function () use ($account) {
            Transaction::create([
                'vendor_id' => $this->vendor->id,
                'amount' => $this->amount,
                'type' => 'withdrawal',
                'status' => 'initiated',
                'metadata' => [
                    'bank_account_id' => $account->id,
                    'bank_name' => $account->bank_name,
                    'bank_last4' => $account->account_last4,
                    'account_holder_name' => $account->account_holder_name,
                ],
            ]);
        });

        $this->showModal = false;
        $this->amount = null;
        $this->selectedBankAccountId = null;
        $this->loadWithdrawRequests();
        $this->loadStats();
        session()->flash('message', 'Withdrawal request submitted successfully.');
    }

    public function setDefault($id)
    {
        $account = BankAccount::where('vendor_id', $this->vendor->id)->findOrFail($id);
        BankAccount::where('vendor_id', $this->vendor->id)->where('is_default', true)->update(['is_default' => false]);
        $account->is_default = true;
        $account->save();
        $this->loadBankAccounts();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->showDeleteModal = true;
    }

    public function deleteAccount()
    {
        $account = BankAccount::where('vendor_id', $this->vendor->id)->findOrFail($this->deleteId);
        $wasDefault = $account->is_default;
        $account->delete();

        if ($wasDefault) {
            $first = BankAccount::where('vendor_id', $this->vendor->id)->first();
            if ($first) {
                $first->is_default = true;
                $first->save();
            }
        }

        $this->showDeleteModal = false;
        $this->deleteId = null;
        $this->loadBankAccounts();
    }

    public function render()
    {
        return view('livewire.vendor.payments.index');
    }
}
