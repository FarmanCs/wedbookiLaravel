<?php

namespace App\Livewire\Vendor\Bookings;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking\Booking;
use App\Models\Vendor\VendorPurchase;
use App\Models\Subscription\CreditsTransaction;
use App\Models\Subscription\PlanTransaction;
use App\Models\Business\Business;

#[Layout('components.layouts.vendor.vendor')]
class VendorBookingComponent extends Component
{
    use WithPagination;

    public $vendor;
    public $selectedStatus = 'all';
    public $searchQuery = '';
    public $sortBy = 'created_at';
    public $sortOrder = 'desc';
    public $activeTab = 'purchases'; // 'purchases' or 'bookings'

    // Modal states
    public $showDetailsModal = false;
    public $showActionModal = false;
    public $showCancelModal = false;
    public $selectedItem = null;
    public $itemType = null; // 'booking' or 'purchase'
    public $actionType = null; // 'accept' or 'reject'
    public $actionReason = '';
    public $cancelReason = '';

    protected $queryString = [
        'selectedStatus' => ['except' => 'all'],
        'searchQuery' => ['except' => ''],
        'sortBy' => ['except' => 'created_at'],
        'sortOrder' => ['except' => 'desc'],
        'activeTab' => ['except' => 'purchases'],
    ];

    public function mount()
    {
        $this->vendor = Auth::guard('vendor')->user();
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
        $this->selectedStatus = 'all';
        $this->searchQuery = '';
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

    // ── Vendor Purchase Methods (Credits & Plans) ───────────────────────────

    public function viewPurchaseDetails($purchaseId)
    {
        $purchase = CreditsTransaction::with('business', 'creditPlan')->find($purchaseId);
        if ($purchase && $purchase->business->vendor_id === $this->vendor->id) {
            $this->selectedItem = $this->formatPurchase($purchase);
            $this->itemType = 'purchase';
            $this->showDetailsModal = true;
        }
    }

    public function openCancelModal($purchaseId)
    {
        $purchase = CreditsTransaction::find($purchaseId);
        if ($purchase && $purchase->business->vendor_id === $this->vendor->id) {
            $this->selectedItem = $this->formatPurchase($purchase);
            $this->itemType = 'purchase';
            $this->cancelReason = '';
            $this->showCancelModal = true;
        }
    }

    public function closeCancelModal()
    {
        $this->showCancelModal = false;
        $this->selectedItem = null;
        $this->cancelReason = '';
    }

    public function cancelPurchase()
    {
        try {
            $purchase = CreditsTransaction::find($this->selectedItem['id']);
            if ($purchase && $purchase->business->vendor_id === $this->vendor->id && $purchase->status === 'completed') {
                // Update transaction status
                $purchase->update([
                    'status' => 'refunded',
                ]);

                $this->dispatch('purchase-updated');
                session()->flash('success', 'Purchase cancelled and refund initiated!');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to cancel purchase: ' . $e->getMessage());
        }
        $this->closeCancelModal();
    }

    protected function formatPurchase($transaction)
    {
        return [
            'id' => $transaction->id,
            'custom_id' => '#P' . str_pad($transaction->id, 6, '0', STR_PAD_LEFT),
            'purchase_id' => '#P' . str_pad($transaction->id, 6, '0', STR_PAD_LEFT),
            'vendor_name' => $transaction->business->vendor->name ?? 'Unknown Vendor',
            'business_id' => $transaction->business_id,
            'business_name' => $transaction->business->company_name ?? 'Unknown Business',
            'amount' => number_format($transaction->amount, 2),
            'total_amount' => number_format($transaction->amount, 2),
            'purchase_date' => $transaction->created_at->format('d M Y'),
            'status' => ucfirst($transaction->status),
            'status_raw' => $transaction->status,
            'created_date' => $transaction->created_at->format('d M Y, g:i A'),
            'stripe_session_id' => $transaction->stripe_session_id,
            'credit_plan' => $transaction->creditPlan->name ?? 'Credits',
            'credits' => $transaction->no_of_credits,
            'type' => 'credit',
        ];
    }

    public function getTotalCreditsProperty()
    {
        return CreditsTransaction::whereHas('business', function ($q) {
            $q->where('vendor_id', $this->vendor->id);
        })
            ->where('status', 'completed')
            ->sum('no_of_credits');
    }

    public function getTotalPlansProperty()
    {
        return PlanTransaction::whereHas('business', function ($q) {
            $q->where('vendor_id', $this->vendor->id);
        })
            ->count();
    }

    public function getPurchasesProperty()
    {
        $query = CreditsTransaction::whereHas('business', function ($q) {
            $q->where('vendor_id', $this->vendor->id);
        })
            ->with('business', 'creditPlan');

        if ($this->selectedStatus !== 'all') {
            $query->where('status', $this->selectedStatus);
        }

        if ($this->searchQuery) {
            $query->where(function ($q) {
                $q->where('stripe_session_id', 'like', '%' . $this->searchQuery . '%')
                    ->orWhereHas('business', fn($q) => $q->where('company_name', 'like', '%' . $this->searchQuery . '%'));
            });
        }

        $query->orderBy($this->sortBy, $this->sortOrder);

        return $query->paginate(10);
    }

    // ── Booking Methods (existing) ───────────────────────────────────────────

    public function viewBookingDetails($bookingId)
    {
        $booking = Booking::with('host', 'business', 'package')->find($bookingId);
        if ($booking && $booking->vendor_id === $this->vendor->id) {
            $this->selectedItem = $this->formatBooking($booking);
            $this->itemType = 'booking';
            $this->showDetailsModal = true;
        }
    }

    public function openActionModal($bookingId, $type)
    {
        $booking = Booking::find($bookingId);
        if ($booking && $booking->vendor_id === $this->vendor->id) {
            $this->selectedItem = $this->formatBooking($booking);
            $this->itemType = 'booking';
            $this->actionType = $type;
            $this->actionReason = '';
            $this->showActionModal = true;
        }
    }

    public function closeDetailsModal()
    {
        $this->showDetailsModal = false;
        $this->selectedItem = null;
        $this->itemType = null;
    }

    public function closeActionModal()
    {
        $this->showActionModal = false;
        $this->selectedItem = null;
        $this->actionType = null;
        $this->actionReason = '';
    }

    public function acceptBooking()
    {
        try {
            $booking = Booking::find($this->selectedItem['id']);
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
            $booking = Booking::find($this->selectedItem['id']);
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
            $booking = Booking::find($this->selectedItem['id']);
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
        return view('livewire.vendor.bookings.modern-index', [
            'purchases' => $this->purchases,
            'bookings' => $this->bookings,
            'totalCredits' => $this->totalCredits,
            'totalPlans' => $this->totalPlans,
        ]);
    }
}
