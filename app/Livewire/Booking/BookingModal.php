<?php

namespace App\Livewire\Booking;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Business\Business;
use App\Models\Business\Package;
use App\Models\Business\Service;
use Illuminate\Support\Facades\Auth;

class BookingModal extends Component
{
    public $businessId;
    public $itemType;
    public $itemId;
    public bool $isOpen = false;
    public int $step = 1;

    public string $name  = '';
    public string $email = '';
    public string $selectedDate     = '';
    public string $selectedTimeSlot = '';
    public array  $selectedAddons   = [];
    public float  $totalPrice       = 0;

    public $business;
    public $selectedItem;
    public array $availableAddons = [];

    public function mount($businessId = null)
    {
        $this->businessId = $businessId;

        if ($businessId) {
            $this->business = Business::find($businessId);
            $this->loadAvailableAddons();
        }

        if (Auth::check()) {
            $user        = Auth::user();
            $this->name  = $user->full_name ?? '';
            $this->email = $user->email ?? '';
        }
    }

    #[On('openBookingModal')]
    public function openModal(string $type, int $id): void
    {
        $this->itemType = $type;
        $this->itemId   = $id;

        $this->loadSelectedItem();

        if (!$this->selectedItem) {
            return;
        }

        $this->resetStep();
        $this->isOpen = true;
    }

    private function loadSelectedItem(): void
    {
        if ($this->itemType === 'package') {
            $this->selectedItem = Package::find($this->itemId);
        } elseif ($this->itemType === 'service') {
            $this->selectedItem = Service::find($this->itemId);
        }
        $this->calculateTotal();
    }

    private function loadAvailableAddons(): void
    {
        if ($this->business?->vendor?->services) {
            $this->availableAddons = $this->business->vendor->services->map(fn($s) => [
                'id'    => $s->id,
                'name'  => $s->name,
                'price' => (float) $s->price,
            ])->toArray();
        }
    }

    public function calculateTotal(): void
    {
        $total = $this->selectedItem ? (float) $this->selectedItem->price : 0;
        foreach ($this->selectedAddons as $addonId) {
            $addon = collect($this->availableAddons)->firstWhere('id', $addonId);
            if ($addon) $total += $addon['price'];
        }
        $this->totalPrice = $total;
    }

    public function updatedSelectedAddons(): void
    {
        $this->calculateTotal();
    }

    public function nextStep(): void
    {
        if ($this->step === 1) {
            $this->validate([
                'name'  => 'required|string|min:2',
                'email' => 'required|email',
            ]);
        } elseif ($this->step === 2) {
            $this->validate([
                'selectedDate'     => 'required|date|after_or_equal:today',
                'selectedTimeSlot' => 'required|string',
            ]);
        }
        $this->step++;
    }

    public function previousStep(): void
    {
        $this->step--;
    }

    public function resetStep(): void
    {
        $this->step             = 1;
        $this->selectedDate     = '';
        $this->selectedTimeSlot = '';
        $this->selectedAddons   = [];
        $this->totalPrice       = 0;
        if ($this->selectedItem) $this->calculateTotal();
    }

    public function confirmBooking(): void
    {
        $this->validate([
            'name'             => 'required|string|min:2',
            'email'            => 'required|email',
            'selectedDate'     => 'required|date|after_or_equal:today',
            'selectedTimeSlot' => 'required|string',
        ]);

        // TODO: save booking to DB here

        session()->flash('booking_success', 'Booking request sent successfully!');
        $this->isOpen = false;
        $this->resetStep();
    }

    public function closeModal(): void
    {
        $this->isOpen = false;
        $this->resetStep();
    }

    public function render()
    {
        return view('livewire.booking.booking-modal');
    }
}
