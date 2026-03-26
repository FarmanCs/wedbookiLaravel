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
    public $isOpen = false;
    public $step = 1;

    public $name = '';
    public $email = '';
    public $selectedDate = '';
    public $selectedTimeSlot = '';
    public $selectedAddons = [];
    public $totalPrice = 0;

    public $business;
    public $selectedItem;
    public $availableAddons = [];

    public function mount($businessId = null)
    {
        $this->businessId = $businessId;
        if ($businessId) {
            $this->business = Business::find($businessId);
            $this->loadAvailableAddons();
        }

        if (Auth::check()) {
            $user = Auth::user();
            $this->name = $user->full_name ?? '';
            $this->email = $user->email ?? '';
        }
    }

    #[On('openBookingModal')]
    public function openModal($type, $id)
    {
        // Log that the event was received (optional, check storage/logs/laravel.log)
        \Log::info('BookingModal openModal called', ['type' => $type, 'id' => $id]);

        try {
            $this->itemType = $type;
            $this->itemId = $id;
            $this->loadSelectedItem();

            if (!$this->selectedItem) {
                session()->flash('error', 'The selected item could not be found.');
                $this->isOpen = false;
                return;
            }

            $this->resetStep();
            $this->isOpen = true;
        } catch (\Exception $e) {
            \Log::error('BookingModal openModal error: ' . $e->getMessage());
            session()->flash('error', 'Unable to open booking form. Please try again.');
            $this->isOpen = false;
        }
    }

    private function loadSelectedItem()
    {
        if ($this->itemType === 'package') {
            $this->selectedItem = Package::find($this->itemId);
        } elseif ($this->itemType === 'service') {
            $this->selectedItem = Service::find($this->itemId);
        }
        $this->calculateTotal();
    }

    private function loadAvailableAddons()
    {
        if ($this->business && $this->business->vendor && $this->business->vendor->services) {
            $this->availableAddons = $this->business->vendor->services->map(function ($service) {
                return [
                    'id' => $service->id,
                    'name' => $service->name,
                    'price' => (float) $service->price,
                ];
            })->toArray();
        } else {
            $this->availableAddons = [];
        }
    }

    public function calculateTotal()
    {
        $total = $this->selectedItem ? (float) $this->selectedItem->price : 0;
        foreach ($this->selectedAddons as $addonId) {
            $addon = collect($this->availableAddons)->firstWhere('id', $addonId);
            if ($addon) {
                $total += $addon['price'];
            }
        }
        $this->totalPrice = $total;
    }

    public function updatedSelectedAddons()
    {
        $this->calculateTotal();
    }

    public function nextStep()
    {
        if ($this->step == 1) {
            $this->validate([
                'name' => 'required|string|min:2',
                'email' => 'required|email',
            ]);
        } elseif ($this->step == 2) {
            $this->validate([
                'selectedDate' => 'required|date|after_or_equal:today',
                'selectedTimeSlot' => 'required|string',
            ]);
        }
        $this->step++;
    }

    public function previousStep()
    {
        $this->step--;
    }

    public function resetStep()
    {
        $this->step = 1;
        $this->selectedDate = '';
        $this->selectedTimeSlot = '';
        $this->selectedAddons = [];
        $this->totalPrice = 0;
        if ($this->selectedItem) {
            $this->calculateTotal();
        }
    }

    public function confirmBooking()
    {
        $this->validate([
            'name' => 'required|string|min:2',
            'email' => 'required|email',
            'selectedDate' => 'required|date|after_or_equal:today',
            'selectedTimeSlot' => 'required|string',
        ]);

        // Store booking logic here...
        $this->dispatch('bookingConfirmed', [
            'item' => $this->selectedItem,
            'date' => $this->selectedDate,
            'time' => $this->selectedTimeSlot,
            'addons' => $this->selectedAddons,
            'total' => $this->totalPrice,
            'name' => $this->name,
            'email' => $this->email,
        ]);

        session()->flash('booking_success', 'Booking request sent successfully!');
        $this->isOpen = false;
        $this->resetStep();
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetStep();
    }

    public function render()
    {
        return view('livewire.booking.booking-modal');
    }
}
