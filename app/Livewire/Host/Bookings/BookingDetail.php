<?php

namespace App\Livewire\Host\Bookings;

use App\Models\Booking\Booking;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.host.host')]
#[Title('Booking Details')]
class BookingDetail extends Component
{
    public Booking $booking;
    public $showCancelModal = false;
    public $cancelReason = '';

    public function mount($id)
    {
        $this->booking = Booking::with([
            'business.vendor',
            'vendor',
            'package',
            'venue',
            'transactions'
        ])
            ->where('host_id', Auth::guard('host')->id())
            ->findOrFail($id);
    }

    /**
     * Initiate payment via Stripe
     */
    public function initiatePayment()
    {
        if (!$this->booking->canBePaid()) {
            session()->flash('error', 'This booking cannot be paid at this time.');
            return;
        }

        // Redirect to payment controller to create Stripe session
        return redirect()->route('host.bookings.payment.create', [
            'booking' => $this->booking->id,
        ]);
    }

    /**
     * Open cancel booking modal
     */
    public function openCancelModal()
    {
        $this->showCancelModal = true;
        $this->cancelReason = '';
    }

    /**
     * Close cancel booking modal
     */
    public function closeCancelModal()
    {
        $this->showCancelModal = false;
        $this->cancelReason = '';
    }

    /**
     * Cancel booking
     */
    public function cancelBooking()
    {
        if (!in_array($this->booking->status, ['pending', 'confirmed'])) {
            session()->flash('error', 'This booking cannot be cancelled.');
            return;
        }

        $this->validate([
            'cancelReason' => 'required|string|min:10|max:500',
        ]);

        try {
            $this->booking->update([
                'status' => 'cancelled',
                'special_requests' => $this->booking->special_requests . "\n\nCancellation Reason: " . $this->cancelReason,
            ]);

            // TODO: Send cancellation notification to vendor
            // dispatch(new SendBookingCancellationNotification($this->booking));

            session()->flash('success', 'Booking cancelled successfully.');
            $this->closeCancelModal();

            return redirect()->route('host.bookings.index');
        } catch (\Exception $e) {
            logger()->error('Booking Cancellation Error: ' . $e->getMessage());
            session()->flash('error', 'Failed to cancel booking. Please try again.');
        }
    }

    /**
     * Download invoice (if available)
     */
    public function downloadInvoice()
    {
        // TODO: Implement invoice generation and download
        session()->flash('info', 'Invoice download feature coming soon.');
    }

    public function render()
    {
        return view('livewire.host.bookings.booking-detail', [
            'booking' => $this->booking,
        ]);
    }
}
