<?php

namespace App\Livewire\Vendor\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Vendor\Vendor;
use App\Models\Business\Business;
use App\Models\Business\Package;
use App\Models\Timing\Timing;
use App\Models\Category\Category;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.vendor.vendor')]
class Index extends Component
{
    use WithFileUploads;

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

    // Modal states
    public $showAvailabilityModal = false;
    public $showPackageModal = false;
    public $showMessageModal = false;
    public $showProfileModal = false;
    public $showBusinessModal = false;

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

    public $showBoostModal = false;
    public $boostBusinessId = null;
    public $boostBusinesses = [];

    // Profile form
    public $profile = [
        'full_name' => '',
        'email' => '',
        'phone_no' => '',
        'country_code' => '',
        'about' => '',
    ];
    public $profile_image;
    public $profile_image_preview;

    // Business form (matches Business model fields)
    public $businessForm = [
        'company_name' => '',
        'category_id' => '',
        'business_desc' => '',
        'business_email' => '',
        'business_phone' => '',
        'street_address' => '',
        'city' => '',
        'country' => '',
    ];
    public $categories = [];

    // Countdown
    public $upcomingEvents = [];

    public function mount()
    {
        $this->vendor = Auth::guard('vendor')->user();

        if ($this->vendor) {
            $this->loadBusinesses();
            $this->loadCategories();
            $this->loadDashboardData();
            $this->loadUpcomingEvents();
        }
    }

    public function openBoostModal()
    {
        $this->loadBusinesses(); // Reload businesses
        if (empty($this->businesses)) {
            session()->flash('error', 'Please create a business first before boosting.');
            return;
        }
        // Prepare businesses for dropdown
        $this->boostBusinesses = $this->businesses; // Already has id and business_name
        $this->boostBusinessId = $this->businesses[0]['id'] ?? null;
        $this->showBoostModal = true;
    }

    public function closeBoostModal()
    {
        $this->showBoostModal = false;
        $this->reset(['boostBusinessId', 'boostBusinesses']);
    }

    public function confirmBoost()
    {
        $this->validate([
            'boostBusinessId' => 'required|exists:businesses,id',
        ]);

        $business = Business::where('id', $this->boostBusinessId)
            ->where('vendor_id', $this->vendor->id)
            ->firstOrFail();

        // Toggle the is_featured flag
        $business->update(['is_featured' => !$business->is_featured]);

        $this->closeBoostModal();
        session()->flash('success', 'Business boost status updated successfully!');
        $this->dispatch('boost-updated');
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

    public function loadBusinesses()
    {
        try {
            $this->businesses = $this->vendor->businesses()
                ->select('id', 'company_name')
                ->get()
                ->map(fn($b) => [
                    'id' => $b->id,
                    'business_name' => $b->company_name // Map to display name
                ])
                ->toArray();

            if (count($this->businesses) > 0) {
                $this->selectedBusiness = $this->businesses[0]['id'];
            }
        } catch (\Exception $e) {
            \Log::error('loadBusinesses error: ' . $e->getMessage());
            $this->businesses = [];
        }
    }

    public function loadCategories()
    {
        $this->categories = Category::pluck('type', 'id')->toArray();
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

    // ==================== PROFILE ====================
    public function openProfileModal()
    {
        $this->profile = [
            'full_name' => $this->vendor->full_name,
            'email' => $this->vendor->email,
            'phone_no' => $this->vendor->phone_no,
            'country_code' => $this->vendor->country_code,
            'about' => $this->vendor->about,
        ];
        $this->showProfileModal = true;
    }

    public function closeProfileModal()
    {
        $this->showProfileModal = false;
        $this->reset(['profile', 'profile_image', 'profile_image_preview']);
    }

    public function updatedProfileImage()
    {
        $this->validate([
            'profile_image' => 'image|max:2048', // 2MB max
        ]);
        $this->profile_image_preview = $this->profile_image->temporaryUrl();
    }

    public function saveProfile()
    {
        $this->validate([
            'profile.full_name' => 'required|string|max:255',
            'profile.email' => 'required|email|unique:vendors,email,' . $this->vendor->id,
            'profile.phone_no' => 'nullable|string|max:20',
            'profile.country_code' => 'nullable|string|max:10',
            'profile.about' => 'nullable|string',
            'profile_image' => 'nullable|image|max:2048',
        ]);

        $data = $this->profile;
        if ($this->profile_image) {
            $path = $this->profile_image->store('vendor-profiles', 'public');
            $data['profile_image'] = $path;
        }

        $this->vendor->update($data);
        $this->closeProfileModal();
        session()->flash('success', 'Profile updated successfully!');
    }

    // ==================== BUSINESS ====================
    public function openBusinessModal($businessId = null)
    {
        $this->loadCategories();
        if ($businessId) {
            $business = Business::findOrFail($businessId);
            $this->businessForm = [
                'company_name' => $business->company_name,
                'category_id' => $business->category_id,
                'business_desc' => $business->business_desc,
                'business_email' => $business->business_email,
                'business_phone' => $business->business_phone,
                'street_address' => $business->street_address,
                'city' => $business->city,
                'country' => $business->country,
            ];
        } else {
            $this->reset('businessForm');
        }
        $this->showBusinessModal = true;
    }

    public function closeBusinessModal()
    {
        $this->showBusinessModal = false;
        $this->reset('businessForm');
    }

    public function saveBusiness()
    {
        $this->validate([
            'businessForm.company_name' => 'required|string|max:255',
            'businessForm.category_id' => 'required|exists:categories,id',
            'businessForm.business_desc' => 'nullable|string',
            'businessForm.business_email' => 'nullable|email',
            'businessForm.business_phone' => 'nullable|string',
            'businessForm.street_address' => 'nullable|string',
            'businessForm.city' => 'nullable|string',
            'businessForm.country' => 'nullable|string',
        ]);

        $businessData = array_merge($this->businessForm, ['vendor_id' => $this->vendor->id]);

        if (isset($businessData['id'])) {
            $business = Business::find($businessData['id']);
            $business->update($businessData);
            $message = "Business '{$business->company_name}' updated successfully!";
        } else {
            $business = Business::create($businessData);
            $message = "Business '{$business->company_name}' created successfully!";
        }

        $this->closeBusinessModal();
        $this->loadBusinesses(); // refresh list
        session()->flash('success', $message);
    }

    // ==================== BOOST PROFILE ====================
    public function toggleBoost()
    {
        // Add 'is_boosted' column to vendors table first
        $this->vendor->update(['is_boosted' => !$this->vendor->is_boosted]);
        session()->flash('success', 'Profile boost ' . ($this->vendor->is_boosted ? 'enabled' : 'disabled') . '!');
    }

    // ==================== AVAILABILITY ====================
    public function openAvailabilityModal()
    {
        $this->loadBusinesses();
        if (empty($this->businesses)) {
            session()->flash('error', 'Please create a business first.');
            return;
        }
        $this->showAvailabilityModal = true;
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
        $this->validate([
            'selectedBusiness' => 'required|exists:businesses,id',
            'slotDuration' => 'required|integer|min:15|max:480',
        ]);

        $business = Business::where('id', $this->selectedBusiness)
            ->where('vendor_id', $this->vendor->id)
            ->firstOrFail();

        Timing::updateOrCreate(
            ['business_id' => $business->id],
            [
                'slot_duration' => $this->slotDuration,
                'unavailable_dates' => $this->unavailableDates ?? [],
                'working_hours' => $this->workingHours ?? [],
            ]
        );

        $this->closeAvailabilityModal();
        session()->flash('success', 'Availability updated successfully!');
        $this->dispatch('availability-updated');
    }

    // ==================== PACKAGE ====================
    public function openPackageModal()
    {
        $this->loadBusinesses();
        if (empty($this->businesses)) {
            session()->flash('error', 'Please create a business first.');
            return;
        }
        $this->showPackageModal = true;
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
            'selectedBusiness' => 'required|exists:businesses,id',
            'packageName' => 'required|string|max:255',
            'packagePrice' => 'required|numeric|min:0',
            'packageDescription' => 'required|string',
        ]);

        $business = Business::where('id', $this->selectedBusiness)
            ->where('vendor_id', $this->vendor->id)
            ->firstOrFail();

        $features = $this->packageFeatures
            ? array_map('trim', explode(',', $this->packageFeatures))
            : [];

        $package = Package::create([
            'business_id' => $business->id,
            'name' => $this->packageName,
            'price' => $this->packagePrice,
            'discount' => $this->packageDiscount ?? 0,
            'description' => $this->packageDescription,
            'features' => $features,
            'is_popular' => $this->isPopular,
        ]);

        $this->closePackageModal();
        session()->flash('success', 'Profile updated successfully!');
        session()->flash('success', "Package '{$package->name}' created successfully for {$business->company_name}!");
        $this->dispatch('package-created');
    }
    // public function showCredist() {}

    // ==================== MESSAGE ====================
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
            // Implement actual message sending logic here (e.g., create chat message)
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
            'categories' => $this->categories,
        ]);
    }
}
