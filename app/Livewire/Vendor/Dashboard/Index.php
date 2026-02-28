<?php

namespace App\Livewire\Vendor\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Vendor\Vendor;
use App\Models\Business\Business;
use App\Models\Business\Package;
use App\Models\Timing\Timing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

#[Layout('components.layouts.vendor.vendor')]
class Index extends Component
{
    public $vendor;
    public $pageVisitors = 0;
    public $totalBookings = 0;
    public $totalRevenue = 0;
    public $socialClicks = 0;
    public $recentBookings = [];
    public $reviews = [];
    public $credits = 0;
    public $rating = 0;
    public $ratingCount = 0;

    // Modal states for Quick Actions
    public $showAvailabilityModal = false;
    public $showPackageModal = false;
    public $showMessageModal = false;

    // Form data for modals
    public $selectedBusiness = null;
    public $businesses = [];
    public $unavailableDates = [];
    public $slotDuration = 60;
    public $workingHours = [];

    // Package form
    public $packageName = '';
    public $packagePrice = '';
    public $packageDiscount = '';
    public $packageDescription = '';
    public $packageFeatures = '';
    public $isPopular = false;

    // Message form
    public $messageSubject = '';
    public $messageBody = '';

    // Countdown
    public $upcomingEvents = [];

    public function mount()
    {
        $this->vendor = Auth::guard('vendor')->user();

        if ($this->vendor) {
            $this->loadBusinesses();
            $this->loadDashboardData();
            $this->loadUpcomingEvents();
        }
    }

    public function loadDashboardData()
    {
        try {
            $this->pageVisitors = $this->vendor->bookings()
                ->distinct('host_id')
                ->count('host_id') ?? 0;

            $this->totalBookings = $this->vendor->bookings()
                ->whereIn('status', ['confirmed', 'completed'])
                ->count() ?? 0;

            $this->totalRevenue = $this->vendor->bookings()
                ->whereIn('status', ['confirmed', 'completed'])
                ->where('final_paid', true)
                ->sum('final_amount') ?? 0;

            $this->socialClicks = 0;

            $recentBookingsData = $this->vendor->bookings()
                ->with('host', 'business')
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();

            $this->recentBookings = $recentBookingsData
                ->map(fn($booking) => [
                    'id' => $booking->id,
                    'custom_id' => $booking->custom_booking_id ?? '#B' . str_pad($booking->id, 5, '0', STR_PAD_LEFT),
                    'created' => $booking->created_at->format('d M Y'),
                    'status' => ucfirst($booking->status),
                    'amount' => 'Rs ' . number_format($booking->final_amount ?? $booking->amount ?? 0, 2),
                    'status_color' => in_array($booking->status, ['confirmed', 'completed']) ? 'green' : 'red',
                ])
                ->toArray();

            $this->reviews = [];

            $this->credits = $this->vendor->credits ?? 0;

            $this->rating = round($this->vendor->reviews()->avg('rating') ?? 0, 1);
            $this->ratingCount = $this->vendor->reviews()->count() ?? 0;
        } catch (\Exception $e) {
            \Log::error('Dashboard data loading error: ' . $e->getMessage());
        }
    }

    //Load businesses with multiple fallback methods
    public function loadBusinesses()
    {
        try {
            // Method 1: Try using the relationship
            if ($this->vendor && method_exists($this->vendor, 'businesses')) {
                $businesses = $this->vendor->businesses()
                    ->select('id', 'business_name')
                    ->get();

                if ($businesses && $businesses->count() > 0) {
                    $this->mapBusinesses($businesses);
                    return;
                }
            }

            // Method 2: Direct database query
            $businesses = Business::where('vendor_id', $this->vendor->id)
                ->select('id', 'business_name')
                ->get();
            dd("business: ", $businesses);

            if ($businesses && $businesses->count() > 0) {
                $this->mapBusinesses($businesses);
                return;
            }

            // Method 3: Try with raw query
            $businessesArray = DB::table('businesses')
                ->where('vendor_id', $this->vendor->id)
                ->select('id', 'business_name')
                ->get();

            if ($businessesArray && $businessesArray->count() > 0) {
                $this->businesses = $businessesArray->map(fn($b) => [
                    'id' => $b->id,
                    'business_name' => $b->business_name,
                ])->toArray();

                if (!empty($this->businesses)) {
                    $this->selectedBusiness = $this->businesses[0]['id'];
                }
                return;
            }

            // If we reach here, no businesses found
            $this->businesses = [];
            $this->selectedBusiness = null;
        } catch (\Exception $e) {
            \Log::error('Error loading businesses: ' . $e->getMessage() . ' | Trace: ' . $e->getTraceAsString());
            $this->businesses = [];
            $this->selectedBusiness = null;
        }
    }

    // Helper method to map businesses
    private function mapBusinesses($businesses)
    {
        $this->businesses = $businesses->map(fn($business) => [
            'id' => $business->id,
            'business_name' => $business->business_name,
        ])->toArray();

        DD("busniess:", $this->businesses);
        if (!empty($this->businesses)) {
            $this->selectedBusiness = $this->businesses[0]['id'];
        }
    }
    public function loadUpcomingEvents()
    {
        try {
            $this->upcomingEvents = $this->vendor->bookings()
                ->where('status', 'confirmed')
                ->whereBetween('event_date', [now()->toDateString(), now()->addDays(7)->toDateString()])
                ->with('host', 'business')
                ->orderBy('event_date', 'asc')
                ->get()
                ->map(fn($booking) => [
                    'id' => $booking->id,
                    'host_name' => $booking->host->full_name,
                    'event_date' => $booking->event_date,
                    'days_until' => now()->diffInDays($booking->event_date),
                    'custom_id' => $booking->custom_booking_id,
                ])
                ->toArray();
        } catch (\Exception $e) {
            \Log::error('Error loading upcoming events: ' . $e->getMessage());
            $this->upcomingEvents = [];
        }
    }

    // Open Availability Modal - with real-time business checking

    public function openAvailabilityModal()
    {
        // Fresh reload of businesses
        $this->loadBusinesses();

        // Double-check if we really have no businesses
        if (empty($this->businesses)) {
            // Try one more time with a direct count
            $count = Business::where('vendor_id', $this->vendor->id)->count();

            if ($count === 0) {
                session()->flash('error', 'Please create a business first before updating availability.');
                return;
            } else {
                // Businesses exist but mapping failed, try again
                $this->loadBusinesses();
            }
        }

        // If still empty, show error
        // dd($this->businesses);
        // if (empty($this->businesses)) {
        //     session()->flash('error', 'Unable to load your businesses. Please try again.');
        //     return;
        // }

        $this->showAvailabilityModal = true;

        // Ensure selectedBusiness is set
        if (empty($this->selectedBusiness) && !empty($this->businesses)) {
            $this->selectedBusiness = $this->businesses[0]['id'];
        }
    }

    public function closeAvailabilityModal()
    {
        $this->showAvailabilityModal = false;
        $this->resetAvailabilityForm();
    }

    public function resetAvailabilityForm()
    {
        $this->selectedBusiness = null;
        $this->unavailableDates = [];
        $this->slotDuration = 60;
        $this->workingHours = [];
    }

    public function saveAvailability()
    {
        try {
            if (empty($this->selectedBusiness)) {
                session()->flash('error', 'Please select a business.');
                return;
            }

            // Verify business exists and belongs to vendor
            $business = Business::where('id', $this->selectedBusiness)
                ->where('vendor_id', $this->vendor->id)
                ->first();

            if (!$business) {
                session()->flash('error', 'Invalid business selected.');
                return;
            }

            Timing::updateOrCreate(
                ['business_id' => $this->selectedBusiness],
                [
                    'slot_duration' => $this->slotDuration ?? 60,
                    'unavailable_dates' => $this->unavailableDates ?? [],
                    'working_hours' => $this->workingHours ?? [],
                ]
            );

            $this->closeAvailabilityModal();
            session()->flash('success', 'Availability updated successfully!');
            $this->dispatch('availability-updated');
        } catch (\Exception $e) {
            \Log::error('Error saving availability: ' . $e->getMessage());
            session()->flash('error', 'Failed to update availability. Please try again.');
        }
    }

    /**
     * Open Package Modal - with real-time business checking
     */
    public function openPackageModal()
    {
        // Fresh reload of businesses
        $this->loadBusinesses();

        // Double-check if we really have no businesses
        if (empty($this->businesses)) {
            // Try one more time with a direct count
            $count = Business::where('vendor_id', $this->vendor->id)->count();

            if ($count === 0) {
                session()->flash('error', 'Please create a business first before creating packages.');
                return;
            } else {
                // Businesses exist but mapping failed, try again
                $this->loadBusinesses();
            }
        }

        // dd($this->businesses);
        // If still empty, show error
        // if (empty($this->businesses)) {
        //     session()->flash('error', 'Unable to load your businesses. Please try again.');
        //     return;
        // }

        $this->showPackageModal = true;

        // Ensure selectedBusiness is set
        if (empty($this->selectedBusiness) && !empty($this->businesses)) {
            $this->selectedBusiness = $this->businesses[0]['id'];
        }
    }

    public function closePackageModal()
    {
        $this->showPackageModal = false;
        $this->resetPackageForm();
    }

    public function resetPackageForm()
    {
        $this->packageName = '';
        $this->packagePrice = '';
        $this->packageDiscount = '';
        $this->packageDescription = '';
        $this->packageFeatures = '';
        $this->isPopular = false;
    }

    public function savePackage()
    {
        $this->validate([
            'packageName' => 'required|string|max:255',
            'packagePrice' => 'required|numeric|min:0',
            'packageDescription' => 'required|string',
        ]);

        try {
            if (empty($this->selectedBusiness)) {
                session()->flash('error', 'Please select a business.');
                return;
            }

            // Verify business exists and belongs to vendor
            $business = Business::where('id', $this->selectedBusiness)
                ->where('vendor_id', $this->vendor->id)
                ->first();

            if (!$business) {
                session()->flash('error', 'Invalid business selected.');
                return;
            }

            // Parse features
            $features = $this->packageFeatures
                ? array_map('trim', explode(',', $this->packageFeatures))
                : [];

            // Create package
            Package::create([
                'business_id' => $this->selectedBusiness,
                'name' => $this->packageName,
                'price' => $this->packagePrice,
                'discount' => $this->packageDiscount ?? 0,
                'description' => $this->packageDescription,
                'features' => $features,
                'is_popular' => $this->isPopular,
            ]);

            $this->closePackageModal();
            session()->flash('success', 'Package created successfully!');
            $this->dispatch('package-created');
        } catch (\Exception $e) {
            \Log::error('Error saving package: ' . $e->getMessage());
            session()->flash('error', 'Failed to create package. Please try again.');
        }
    }

    public function openMessageModal()
    {
        $this->showMessageModal = true;
    }

    public function closeMessageModal()
    {
        $this->showMessageModal = false;
        $this->messageSubject = '';
        $this->messageBody = '';
    }

    public function sendMessage()
    {
        $this->validate([
            'messageSubject' => 'required|string|max:255',
            'messageBody' => 'required|string|min:10',
        ]);

        try {
            $this->closeMessageModal();
            session()->flash('success', 'Message sent successfully!');
        } catch (\Exception $e) {
            \Log::error('Error sending message: ' . $e->getMessage());
            session()->flash('error', 'Failed to send message');
        }
    }

    public function render()
    {
        return view('livewire.vendor.dashboard.index', [
            'vendor' => $this->vendor,
            'pageVisitors' => $this->pageVisitors,
            'totalBookings' => $this->totalBookings,
            'totalRevenue' => $this->totalRevenue,
            'socialClicks' => $this->socialClicks,
            'recentBookings' => $this->recentBookings,
            'reviews' => $this->reviews,
            'credits' => $this->credits,
            'rating' => $this->rating,
            'ratingCount' => $this->ratingCount,
            'upcomingEvents' => $this->upcomingEvents,
            'businesses' => $this->businesses,
        ]);
    }
}
