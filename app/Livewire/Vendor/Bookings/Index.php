<?php

namespace App\Livewire\Vendor\Bookings;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking\Booking;

#[Layout('components.layouts.vendor.vendor')]
class Index extends Component
{
    use WithPagination;

    public $vendor;
    public $selectedStatus = 'all';
    public $searchQuery = '';
    public $sortBy = 'created_at';
    public $sortOrder = 'desc';

    // Modal states
    public $showDetailsModal = false;
    public $showActionModal = false;
    public $selectedBooking = null;
    public $actionType = null; // 'accept' or 'reject'
    public $actionReason = '';

    protected $queryString = [
        'selectedStatus' => ['except' => 'all'],
        'searchQuery' => ['except' => ''],
        'sortBy' => ['except' => 'created_at'],
        'sortOrder' => ['except' => 'desc'],
    ];

    public function mount()
    {
        $this->vendor = Auth::guard('vendor')->user();
    }

    public function updatedSelectedStatus()
    {
        $this->resetPage();
    }

    public function updatedSearchQuery()
    {
        $this->resetPage();
    }

    public function updateSort($sortBy)
    {
        if ($this->sortBy === $sortBy) {
            $this->sortOrder = $this->sortOrder === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $sortBy;
            $this->sortOrder = 'desc';
        }
        $this->resetPage();
    }

    public function viewDetails($bookingId)
    {
        $booking = Booking::with('host', 'business', 'package')->find($bookingId);
        if ($booking && $booking->vendor_id === $this->vendor->id) {
            $this->selectedBooking = $this->formatBooking($booking);
            $this->showDetailsModal = true;
        }
    }

    public function openActionModal($bookingId, $type)
    {
        $booking = Booking::find($bookingId);
        if ($booking && $booking->vendor_id === $this->vendor->id) {
            $this->selectedBooking = $this->formatBooking($booking);
            $this->actionType = $type;
            $this->actionReason = '';
            $this->showActionModal = true;
        }
    }

    public function closeDetailsModal()
    {
        $this->showDetailsModal = false;
        $this->selectedBooking = null;
    }

    public function closeActionModal()
    {
        $this->showActionModal = false;
        $this->selectedBooking = null;
        $this->actionType = null;
        $this->actionReason = '';
    }

    public function acceptBooking()
    {
        try {
            $booking = Booking::find($this->selectedBooking['id']);
            if ($booking && $booking->vendor_id === $this->vendor->id) {
                $booking->update([
                    'status' => 'confirmed',
                    'approved_at' => now()
                ]);
                $this->dispatch('booking-updated');
                session()->flash('success', 'Booking accepted successfully!');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to accept booking');
        }
        $this->closeActionModal();
    }

    public function rejectBooking()
    {
        try {
            $booking = Booking::find($this->selectedBooking['id']);
            if ($booking && $booking->vendor_id === $this->vendor->id) {
                $booking->update(['status' => 'rejected']);
                $this->dispatch('booking-updated');
                session()->flash('success', 'Booking rejected successfully!');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to reject booking');
        }
        $this->closeActionModal();
    }

    public function completeBooking()
    {
        try {
            $booking = Booking::find($this->selectedBooking['id']);
            if ($booking && $booking->vendor_id === $this->vendor->id) {
                $booking->update([
                    'status' => 'completed',
                    'payment_completed_at' => now()
                ]);
                $this->dispatch('booking-updated');
                session()->flash('success', 'Booking marked as completed!');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to complete booking');
        }
        $this->closeDetailsModal();
    }

    protected function formatBooking($booking)
    {
        
        return [
            'id' => $booking->id,
            'custom_id' => $booking->custom_booking_id ?? '#B' . str_pad($booking->id, 5, '0', STR_PAD_LEFT),
            'host_name' => $booking->host->full_name ?? 'Unknown Host',
            'host_id' => $booking->host_id,
            'host_email' => $booking->host->email ?? 'N/A',
            'host_phone' => $booking->host->phone_no ?? 'N/A',
            'business_name' => $booking->business->business_name ?? 'Unknown Business',
            'business_id' => $booking->business_id,
            'package_name' => $booking->package->package_name ?? 'Custom Package',
            'event_date' => $booking->event_date ? $booking->event_date->format('d M Y') : 'N/A',
            'created_date' => $booking->created_at->format('d M Y'),
            'status_raw' => $booking->status,
            'status' => ucfirst($booking->status),
            'amount' => number_format($booking->amount ?? 0, 2),
            'final_amount' => number_format($booking->final_amount ?? $booking->amount ?? 0, 2),
            'advance_amount' => number_format($booking->advance_amount ?? 0, 2),
            'advance_percentage' => $booking->advance_percentage ?? 0,
            'advance_paid' => $booking->advance_paid ? 'Paid' : 'Pending',
            'final_paid' => $booking->final_paid ? 'Paid' : 'Pending',
            'payment_status' => ucfirst(str_replace('Paid', ' Paid', $booking->payment_status)),
            'guests' => $booking->guests ?? 0,
            'time_slot' => ucfirst($booking->time_slot ?? 'N/A'),
            'timezone' => $booking->timezone ?? 'UTC',
            'advance_due_date' => $booking->advance_due_date ? $booking->advance_due_date->format('d M Y') : 'N/A',
            'final_due_date' => $booking->final_due_date ? $booking->final_due_date->format('d M Y') : 'N/A',
            'approved_at' => $booking->approved_at ? $booking->approved_at->format('d M Y, g:i A') : 'N/A',
            'extra_services' => $booking->extra_services ? implode(', ', (array) $booking->extra_services) : 'None',
        ];
    }

    public function getBookingsProperty()
    {
        $query = Booking::where('vendor_id', $this->vendor->id)
            ->with('host', 'business', 'package');

        if ($this->selectedStatus !== 'all') {
            $query->where('status', $this->selectedStatus);
        }

        if ($this->searchQuery) {
            $query->where(function ($q) {
                $q->where('custom_booking_id', 'like', '%' . $this->searchQuery . '%')
                  ->orWhereHas('host', fn($q) => $q->where('full_name', 'like', '%' . $this->searchQuery . '%'));
            });
        }

        $query->orderBy($this->sortBy, $this->sortOrder);

        return $query->paginate(10);
    }

    public function render()
    {
        return view('livewire.vendor.bookings.index', [
            'bookings' => $this->bookings,
        ]);
    }
}