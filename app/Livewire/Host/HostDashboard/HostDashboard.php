<?php

namespace App\Livewire\Host\HostDashboard;

use App\Models\Booking\Booking;
use App\Models\Guest\Guest;
use App\Models\Guest\GuestGroup;
use App\Models\Business\Package;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

#[Layout('components.layouts.host.host')]
#[Title('Dashboard')]
class HostDashboard extends Component
{
    public $host;

    // Filter & Search
    public string $vendorSearch = '';
    public string $statusFilter = 'all';
    public string $sortBy = 'recent';

    // Stats
    public int $totalVendors = 0;
    public int $confirmedVendors = 0;
    public int $totalGuests = 0;
    public int $respondedGuests = 0;
    public string $budgetTotal = 'PKR 0';
    public string $budgetSpent = 'PKR 0';

    // Collections
    public array $recentBookings = [];
    public array $bookedVendors = [];
    public array $guestGroups = [];
    public array $recentActivity = [];
    public array $packages = [];

    // Pagination
    public int $perPage = 6;
    public int $currentPage = 1;

    public function mount(): void
    {
        $this->host = Auth::guard('host')->user();
        $this->loadDashboardData();
    }

    /**
     * Load all dashboard data
     */
    public function loadDashboardData(): void
    {
        $this->loadVendorStats();
        $this->loadGuestStats();
        $this->loadBudgetStats();
        $this->loadRecentBookings();
        $this->loadBookedVendors();
        $this->loadGuestGroups();
        $this->loadRecentActivity();
        $this->loadPackages();
    }

    /**
     * Load vendor statistics
     */
    private function loadVendorStats(): void
    {
        $this->totalVendors = Booking::where('host_id', $this->host->id)
            ->distinct()
            ->count('business_id');

        $this->confirmedVendors = Booking::where('host_id', $this->host->id)
            ->whereIn('status', ['confirmed', 'completed'])
            ->distinct()
            ->count('business_id');
    }

    /**
     * Load guest statistics
     */
    private function loadGuestStats(): void
    {
        // Total guests from all guest groups
        $this->totalGuests = Guest::whereHas('guestGroups', function ($query) {
            $query->where('host_id', $this->host->id);
        })->count();

        // Guests who confirmed attendance (is_joining = true)
        $this->respondedGuests = Guest::whereHas('guestGroups', function ($query) {
            $query->where('host_id', $this->host->id);
        })->where('is_joining', true)->count();
    }

    /**
     * Load budget statistics
     */
    private function loadBudgetStats(): void
    {
        $eventBudget = $this->host->event_budget ?? 0;
        $this->budgetTotal = 'PKR ' . number_format($eventBudget, 0);

        // Sum of confirmed and completed bookings
        $totalSpent = Booking::where('host_id', $this->host->id)
            ->whereIn('status', ['confirmed', 'completed'])
            ->sum('amount') ?? 0;

        $this->budgetSpent = 'PKR ' . number_format($totalSpent, 0);
    }

    /**
     * Load recent bookings with filtering and sorting
     */
    private function loadRecentBookings(): void
    {
        $query = Booking::where('host_id', $this->host->id);

        // Apply status filter
        if ($this->statusFilter !== 'all') {
            $query->where('status', $this->statusFilter);
        }

        // Apply search
        if (!empty($this->vendorSearch)) {
            $query->whereHas('business', function ($q) {
                $q->where('company_name', 'like', '%' . $this->vendorSearch . '%');
            });
        }

        // Apply sorting
        switch ($this->sortBy) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'amount_high':
                $query->orderBy('amount', 'desc');
                break;
            case 'amount_low':
                $query->orderBy('amount', 'asc');
                break;
            case 'recent':
            default:
                $query->orderBy('created_at', 'desc');
        }

        $bookings = $query->with('business')
            ->limit($this->perPage)
            ->get();

        $this->recentBookings = $bookings->map(function ($booking) {
            return [
                'id' => $booking->id,
                'booking_id' => $booking->custom_booking_id ?? 'BK-' . $booking->id,
                'vendor' => $booking->business->company_name ?? 'N/A',
                'event_date' => $booking->event_date ? Carbon::parse($booking->event_date)->format('d/M/Y') : 'TBD',
                'created' => $booking->created_at->format('d/M/Y'),
                'status' => $booking->status,
                'amount' => $booking->amount ?? 0,
                'advance_paid' => $booking->advance_paid ?? false,
                'final_paid' => $booking->final_paid ?? false,
            ];
        })->toArray();
    }

    /**
     * Load confirmed/completed booked vendors
     */
    private function loadBookedVendors(): void
    {
        $bookings = Booking::where('host_id', $this->host->id)
            ->with(['business.category', 'package'])
            ->orderByRaw("
            CASE 
                WHEN status = 'confirmed' THEN 1
                WHEN status = 'completed' THEN 2
                WHEN status = 'pending' THEN 3
                ELSE 4
            END
        ")
            ->orderBy('event_date', 'asc')
            ->limit(6)
            ->get();

        $this->bookedVendors = $bookings->map(function ($booking) {
            return [
                'id' => $booking->id,
                'name' => $booking->business->company_name ?? 'Unknown Vendor',
                'category' => optional($booking->business->category)->name ?? 'Uncategorized',
                'status' => $booking->status,
                'amount' => (float) ($booking->amount ?? 0),
                'date' => $booking->event_date
                    ? $booking->event_date->format('M d, Y')
                    : 'TBD',
                'package' => optional($booking->package)->name ?? 'Custom',
                'advance_paid' => (bool) $booking->advance_paid,
                'advance_amount' => (float) ($booking->advance_amount ?? 0),
                'final_amount' => (float) ($booking->final_amount ?? 0),
            ];
        })->toArray();
    }

    /**
     * Load guest groups
     */
    private function loadGuestGroups(): void
    {
        $groups = GuestGroup::where('host_id', $this->host->id)
            ->withCount('guests')
            ->orderByDesc('created_at')
            ->get();

        $this->guestGroups = $groups->map(function ($group) {
            return [
                'id' => $group->id,
                'name' => $group->group_name,
                'count' => $group->guests_count,
                'created' => $group->created_at->format('M d, Y'),
            ];
        })->toArray();
    }

    /**
     * Load recent activity (bookings, groups, RSVP updates)
     */
    private function loadRecentActivity(): void
    {
        // Recent booking status changes
        $recentBookings = Booking::where('host_id', $this->host->id)
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($booking) {
                $statusEmoji = match ($booking->status) {
                    'confirmed' => '✅',
                    'completed' => '🎉',
                    'cancelled' => '❌',
                    'pending' => '⏳',
                    default => '📝'
                };

                return [
                    'action' => $statusEmoji . ' Booking with ' . ($booking->business->company_name ?? 'vendor') . ' ' . ucfirst($booking->status),
                    'time' => $booking->updated_at->diffForHumans(),
                    'type' => 'booking'
                ];
            });

        // Recent guest groups created
        $recentGroups = GuestGroup::where('host_id', $this->host->id)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get()
            ->map(function ($group) {
                return [
                    'action' => '👥 Added guest group: ' . $group->group_name . ' (' . $group->guests_count . ' guests)',
                    'time' => $group->created_at->diffForHumans(),
                    'type' => 'guests'
                ];
            });

        // Combine and sort by time
        $this->recentActivity = collect()
            ->merge($recentBookings)
            ->merge($recentGroups)
            ->sortByDesc(function ($item) {
                // Parse the diffForHumans string to get actual time for sorting
                return strtotime('-' . preg_replace('/[^0-9]/', '', $item['time']) . ' seconds');
            })
            ->values()
            ->take(8)
            ->toArray();
    }

    /**
     * Load available packages for quick booking
     */
    private function loadPackages(): void
    {
        // Get packages from confirmed vendor businesses
        $confirmedBusinessIds = Booking::where('host_id', $this->host->id)
            ->where('status', 'confirmed')
            ->distinct('business_id')
            ->pluck('business_id');

        $packages = Package::whereIn('business_id', $confirmedBusinessIds)
            ->with('business')
            ->where('is_popular', true)
            ->limit(4)
            ->get();

        $this->packages = $packages->map(function ($package) {
            return [
                'id' => $package->id,
                'name' => $package->name,
                'business' => $package->business->company_name ?? 'Unknown',
                'price' => $package->price ?? 0,
                'discount' => $package->discount ?? 0,
                'discount_percentage' => $package->discount_percentage ?? 0,
                'is_popular' => $package->is_popular,
                'features' => $package->features ?? [],
            ];
        })->toArray();
    }

    /**
     * Filter bookings by status
     */
    public function filterByStatus(string $status): void
    {
        $this->statusFilter = $status;
        $this->currentPage = 1;
        $this->loadRecentBookings();
    }

    /**
     * Search vendors
     */
    public function searchVendors(string $search): void
    {
        $this->vendorSearch = $search;
        $this->currentPage = 1;
        $this->loadRecentBookings();
    }

    /**
     * Change sort order
     */
    public function sortBy(string $sort): void
    {
        $this->sortBy = $sort;
        $this->loadRecentBookings();
    }

    /**
     * Refresh dashboard data
     */
    public function refresh(): void
    {
        $this->loadDashboardData();
        $this->dispatch('notification', message: 'Dashboard refreshed successfully!');
    }

    /**
     * Load next page of bookings
     */
    public function nextPage(): void
    {
        $this->currentPage++;
        $this->loadRecentBookings();
    }

    /**
     * Load previous page of bookings
     */
    public function previousPage(): void
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
            $this->loadRecentBookings();
        }
    }

    /**
     * Render the component
     */
    public function render()
    {
        return view('livewire.host.dashboard.host-dashboard', [
            'totalVendors' => $this->totalVendors,
            'confirmedVendors' => $this->confirmedVendors,
            'totalGuests' => $this->totalGuests,
            'respondedGuests' => $this->respondedGuests,
            'budgetTotal' => $this->budgetTotal,
            'budgetSpent' => $this->budgetSpent,
            'recentBookings' => $this->recentBookings,
            'bookedVendors' => $this->bookedVendors,
            'guestGroups' => $this->guestGroups,
            'recentActivity' => $this->recentActivity,
            'packages' => $this->packages,
        ]);
    }
}
