<?php

namespace App\Livewire\Host\Bookings;

use App\Models\Booking\Booking;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

#[Layout('components.layouts.host.host')]
#[Title('Bookings')]
class BookingComponent extends Component
{
    use WithPagination;

    public string $search = '';
    public string $statusFilter = 'all';
    public string $sortBy = 'event_date';
    public string $sortDirection = 'asc';
    public string $bookingType = 'all'; // all, package, venue

    protected $queryString = [
        'search',
        'statusFilter',
        'sortBy',
        'sortDirection',
        'bookingType'
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
    }

    public function updatingBookingType(): void
    {
        $this->resetPage();
    }

    public function sortBy(string $field): void
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function deleteBooking(int $bookingId): void
    {
        $booking = Booking::where('id', $bookingId)
            ->where('host_id', Auth::guard('host')->id())
            ->first();

        if ($booking) {
            $booking->delete();
            session()->flash('success', 'Booking deleted successfully.');
            $this->dispatch('booking-deleted');
        } else {
            session()->flash('error', 'Booking not found or unauthorized.');
        }
    }

    public function cancelBooking(int $bookingId): void
    {
        $booking = Booking::where('id', $bookingId)
            ->where('host_id', Auth::guard('host')->id())
            ->whereIn('status', ['pending', 'confirmed'])
            ->first();

        if ($booking) {
            $booking->update([
                'status' => 'cancelled',
            ]);

            session()->flash('success', 'Booking cancelled successfully.');
            $this->dispatch('booking-cancelled');
        } else {
            session()->flash('error', 'Cannot cancel this booking.');
        }
    }

    /**
     * Initiate Stripe payment for a booking
     * This method creates a Stripe Checkout Session
     */
    public function initiatePayment(int $bookingId)
    {
        try {
            $booking = Booking::with(['business', 'vendor', 'package'])
                ->where('id', $bookingId)
                ->where('host_id', Auth::guard('host')->id())
                ->firstOrFail();

            // Check if already paid
            if ($booking->final_paid) {
                session()->flash('info', 'This booking has already been paid.');
                return;
            }

            // Calculate amount to pay
            $amountToPay = $booking->final_amount;
            if (!$booking->advance_paid && $booking->advance_amount) {
                $amountToPay = $booking->advance_amount;
            } elseif ($booking->advance_paid && !$booking->final_paid) {
                $amountToPay = $booking->final_amount - $booking->advance_amount;
            }

            // Initialize Stripe
            Stripe::setApiKey(config('services.stripe.secret'));

            // Create Stripe Checkout Session
            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $booking->business->company_name ?? 'Event Booking',
                            'description' => sprintf(
                                '%s - %s (Event Date: %s)',
                                $booking->package ? $booking->package->name : 'Custom Venue',
                                $booking->custom_booking_id,
                                $booking->event_date->format('M d, Y')
                            ),
                            'images' => $booking->business && $booking->business->profile_image
                                ? [asset('storage/' . $booking->business->profile_image)]
                                : [],
                        ],
                        'unit_amount' => (int)($amountToPay * 100), // Convert to cents
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('host.bookings.payment.success', ['booking' => $booking->id]) . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('host.bookings.index') . '?payment=cancelled',
                'client_reference_id' => $booking->id,
                'customer_email' => Auth::guard('host')->user()->email,
                'metadata' => [
                    'booking_id' => $booking->id,
                    'host_id' => $booking->host_id,
                    'payment_type' => !$booking->advance_paid ? 'advance' : 'final',
                    'custom_booking_id' => $booking->custom_booking_id,
                ],
            ]);

            // Store session ID temporarily (you may want to save this in booking table)
            session(['stripe_checkout_session_' . $booking->id => $session->id]);

            // Redirect to Stripe Checkout
            return redirect($session->url);
        } catch (\Exception $e) {
            logger()->error('Stripe Payment Error: ' . $e->getMessage());
            session()->flash('error', 'Unable to process payment. Please try again.');
        }
    }

    /**
     * Get filtered and sorted bookings
     */
    private function getBookingsQuery()
    {
        $query = Booking::where('host_id', Auth::guard('host')->id())
            ->with(['business.vendor', 'vendor', 'package']);

        // Filter by booking type
        if ($this->bookingType === 'package') {
            $query->whereNotNull('package_id');
        } elseif ($this->bookingType === 'venue') {
            $query->whereNull('package_id');
        }

        // Search filter
        if ($this->search) {
            $query->where(function ($q) {
                $q->whereHas('business', function ($businessQuery) {
                    $businessQuery->where('company_name', 'like', '%' . $this->search . '%');
                })
                    ->orWhereHas('vendor', function ($vendorQuery) {
                        $vendorQuery->where('full_name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('package', function ($packageQuery) {
                        $packageQuery->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhere('custom_booking_id', 'like', '%' . $this->search . '%');
            });
        }

        // Status filter
        if ($this->statusFilter !== 'all') {
            $query->where('status', $this->statusFilter);
        }

        // Sorting
        $query->orderBy($this->sortBy, $this->sortDirection);

        return $query;
    }

    public function render()
    {
        $bookings = $this->getBookingsQuery()->paginate(10);

        return view('livewire.host.bookings.index', [
            'bookings' => $bookings,
        ]);
    }
}
