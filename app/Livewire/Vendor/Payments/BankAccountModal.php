<?php

namespace App\Livewire\Vendor\Payments;

use App\Models\Booking\BankAccount;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class BankAccountModal extends Component
{
    public $show = false;
    public $accountId;
    public $account_holder_name;
    public $bank_name;
    public $bank_code;
    public $account_number;
    public $account_last4;
    public $iban;
    public $swift;
    public $currency = 'PKR';
    public $is_default = false;
    public $notes;

    protected $rules = [
        'account_holder_name' => 'required|string|max:255',
        'bank_name' => 'required|string|max:255',
        'bank_code' => 'nullable|string|max:50',
        'account_number' => 'nullable|string|max:50',
        'account_last4' => 'nullable|string|size:4',
        'iban' => 'nullable|string|max:34',
        'swift' => 'nullable|string|max:11',
        'currency' => 'required|string|size:3',
        'is_default' => 'boolean',
        'notes' => 'nullable|string',
    ];

    protected $listeners = [
        'openBankAccountModal' => 'open',
        'editBankAccount' => 'edit'
    ];

    public function open()
    {
        $this->resetForm();
        $this->show = true;
    }

    public function edit($id)
    {
        $account = BankAccount::where('vendor_id', Auth::guard('vendor')->id())->findOrFail($id);
        $this->accountId = $account->id;
        $this->account_holder_name = $account->account_holder_name;
        $this->bank_name = $account->bank_name;
        $this->bank_code = $account->bank_code;
        $this->account_number = $account->account_number;
        $this->account_last4 = $account->account_last4;
        $this->iban = $account->iban;
        $this->swift = $account->swift;
        $this->currency = $account->currency;
        $this->is_default = $account->is_default;
        $this->notes = $account->notes;
        $this->show = true;
    }

    public function resetForm()
    {
        $this->reset([
            'accountId',
            'account_holder_name',
            'bank_name',
            'bank_code',
            'account_number',
            'account_last4',
            'iban',
            'swift',
            'currency',
            'is_default',
            'notes'
        ]);
        $this->currency = 'PKR';
    }

    public function save()
    {
        $this->validate();

        $vendor = Auth::guard('vendor')->user();

        if ($this->is_default) {
            BankAccount::where('vendor_id', $vendor->id)
                ->where('is_default', true)
                ->update(['is_default' => false]);
        }

        $data = [
            'vendor_id' => $vendor->id,
            'account_holder_name' => $this->account_holder_name,
            'bank_name' => $this->bank_name,
            'bank_code' => $this->bank_code,
            'account_number' => $this->account_number,
            'account_last4' => $this->account_last4,
            'iban' => $this->iban,
            'swift' => $this->swift,
            'currency' => $this->currency,
            'is_default' => $this->is_default,
            'notes' => $this->notes,
        ];

        if ($this->accountId) {
            $account = BankAccount::where('vendor_id', $vendor->id)->findOrFail($this->accountId);
            $account->update($data);
        } else {
            BankAccount::create($data);
        }

        $this->show = false;
        $this->resetForm();
        $this->dispatch('bankAccountSaved');
    }

    public function render()
    {
        return view('livewire.vendor.payments.bank-account-modal');
    }
}
