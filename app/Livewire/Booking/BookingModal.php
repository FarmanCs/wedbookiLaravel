<?php

namespace App\Livewire\Booking;

use Livewire\Component;
use App\Models\Booking\Booking;
use App\Models\Business\Package;
use App\Models\Business\Service;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class BookingModal extends Component
{
    public bool $isOpen = false;

    public $itemType;
    public $itemId;
    public $selectedItem;

    public int $step = 1;

    public string $name = '';
    public string $email = '';

    public string $selectedDate = '';
    public string $selectedTimeSlot = '';

    public array $selectedAddons = [];
    public array $availableAddons = [];

    public float $totalPrice = 0;


    #[On('bookingModalOpen')]
    public function openBookingModal($type, $id)
    {
        $this->resetExcept('availableAddons');

        $this->itemType = $type;
        $this->itemId   = $id;

        if ($type === 'package') {
            $this->selectedItem = Package::findOrFail($id);
        } elseif ($type === 'service') {
            $this->selectedItem = Service::findOrFail($id);
        }

        if (!$this->selectedItem) return;

        $this->totalPrice = (float) $this->selectedItem->price;

        if (Auth::check()) {
            $this->name  = Auth::user()->full_name ?? '';
            $this->email = Auth::user()->email ?? '';
        }

        $this->step = 1;
        $this->isOpen = true; // 🔥 MODAL OPENS HERE
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function nextStep()
    {
        $this->step++;
    }

    public function previousStep()
    {
        $this->step--;
    }

    public function confirmBooking()
    {
        // if (!Auth::check()) {

        //     session()->flash('error', 'Please login first.');

        //     return redirect()->route('hostlogin');
        // }
        [$start, $end] = explode(' - ', $this->selectedTimeSlot);
        // dd(Auth::guard('host')->id());
        Booking::create([
            'host_id'     => Auth::guard('host')->id(),
            'business_id' => $this->selectedItem->business_id,
            'vendor_id'   => $this->selectedItem->business->vendor_id,

            'package_id'  => $this->itemType === 'package' ? $this->itemId : null,
            'service_id'  => $this->itemType === 'service' ? $this->itemId : null,

            'event_date'  => $this->selectedDate,
            'start_time'  => date('H:i:s', strtotime($start)),
            'end_time'    => date('H:i:s', strtotime($end)),

            'amount'      => $this->totalPrice,
            'status'      => 'pending',
        ]);

        session()->flash('booking_success', 'Booking request sent successfully!');

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.booking.booking-modal');
    }
}
