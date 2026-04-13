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
    public array $vendorCategories = [];
    public array $expenseBreakdown = [];
    public array $checklistTasks = [];
    public int $doneTasks = 0;
    public int $totalTasks = 0;
    public int $overdueTasks = 0;

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

    // Wedding date and countdown
    public $weddingDate;
    public array $countdown = ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 0];
    public bool $showDateModal = false;

    // Event timing details
    public $eventDate;
    public $eventStartTime;
    public $eventEndTime;
    public $eventVenue;
    public string $eventTimingMessage = '';

    /**
     * Open the event timing modal
     */
    public function openEventTimingModal()
    {
        $this->showDateModal = true;
        $this->loadEventTimingDetails();
    }

    /**
     * Close the event timing modal
     */
    public function closeDateModal()
    {
        $this->showDateModal = false;
        $this->eventTimingMessage = '';
    }

    /**
     * Load event timing details from host record
     */
    private function loadEventTimingDetails(): void
    {
        $this->eventDate = $this->host->wedding_date;
        $this->eventStartTime = $this->host->event_start_time ?? '10:00';
        $this->eventEndTime = $this->host->event_end_time ?? '23:00';
        $this->eventVenue = $this->host->event_venue ?? '';
    }

    /**
     * Set the wedding date
     */
    public function setWeddingDate($date)
    {
        // Validate that the date is not in the past
        $selectedDate = Carbon::parse($date)->startOfDay();
        $today = Carbon::now()->startOfDay();

        if ($selectedDate < $today) {
            $this->dispatch('error', message: 'Please select a date that is today or in the future.');
            return;
        }

        $this->host->wedding_date = $date;
        $this->host->save();
        $this->weddingDate = $date;
        $this->eventDate = $date;
        $this->updateCountdown();
        $this->showDateModal = false;
        $this->dispatch('date-set');
        $this->dispatch('success', message: 'Wedding date has been updated successfully!');
    }

    /**
     * Save event timing details (date, time, venue)
     */
    public function saveEventTiming($date, $startTime, $endTime)
    {
        try {
            // Validate that the date is not in the past
            $selectedDate = Carbon::parse($date)->startOfDay();
            $today = Carbon::now()->startOfDay();

            if ($selectedDate < $today) {
                $this->dispatch('error', message: 'Please select a date that is today or in the future.');
                return;
            }

            // Validate times
            $startDateTime = Carbon::createFromFormat('H:i', $startTime);
            $endDateTime = Carbon::createFromFormat('H:i', $endTime);

            if ($endDateTime <= $startDateTime) {
                $this->dispatch('error', message: 'Event end time must be after start time.');
                return;
            }

            // Update host record
            $this->host->update([
                'wedding_date' => $date,
                'event_start_time' => $startTime,
                'event_end_time' => $endTime,
            ]);

            // Update local properties
            $this->weddingDate = $date;
            $this->eventDate = $date;
            $this->eventStartTime = $startTime;
            $this->eventEndTime = $endTime;

            $this->updateCountdown();
            $this->showDateModal = false;

            $this->dispatch('success', message: 'Event timing has been saved successfully!');
        } catch (\Exception $e) {
            $this->dispatch('error', message: 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Update the countdown timer
     */
    public function updateCountdown()
    {
        if (!$this->weddingDate) {
            $this->countdown = ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 0];
            return;
        }

        $now = Carbon::now();
        $eventDate = Carbon::parse($this->weddingDate);

        if ($eventDate < $now) {
            $this->countdown = ['days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 0];
        } else {
            $diff = $now->diff($eventDate);
            $this->countdown = [
                'days' => $diff->days,
                'hours' => $diff->h,
                'minutes' => $diff->i,
                'seconds' => $diff->s,
            ];
        }
    }

    /**
     * Load vendor categories
     */
    private function loadVendorCategories(): void
    {
        // Static list of all categories
        $allCategories = [
            'Cakes And Bakes',
            'Catering',
            'Décor',
            'Entertainment',
            'Event Planning',
            'Flowers',
            'Hairstylist',
            'Henna Artists',
            'Jewelry & Accessories',
            'Makeup Artists',
            'Marquee',
            'Music',
            'Photography And Videography',
            'Venue',
            'Wedding Attire'
        ];

        // Count hired categories based on bookings
        $hiredCategories = Booking::where('host_id', $this->host->id)
            ->whereIn('status', ['confirmed', 'completed'])
            ->with('business.category')
            ->get()
            ->pluck('business.category.name')
            ->unique()
            ->filter()
            ->toArray();

        $this->vendorCategories = [
            'all' => $allCategories,
            'hired' => $hiredCategories,
            'hiredCount' => count($hiredCategories),
            'totalCount' => count($allCategories)
        ];
    }

    /**
     * Load expense breakdown
     */
    private function loadExpenseBreakdown(): void
    {
        $bookings = Booking::where('host_id', $this->host->id)
            ->whereIn('status', ['confirmed', 'completed'])
            ->with('business.category')
            ->get();

        $breakdown = [];
        foreach ($bookings as $booking) {
            $cat = $booking->business->category->name ?? 'Uncategorized';
            $breakdown[$cat] = ($breakdown[$cat] ?? 0) + ($booking->amount ?? 0);
        }
        $this->expenseBreakdown = $breakdown;
    }

    /**
     * Load checklist tasks
     */
    private function loadChecklistTasks(): void
    {
        // Placeholder tasks – replace with actual checklist data
        $this->checklistTasks = [
            ['title' => 'Process Advance Payment', 'due' => 'November 26', 'type' => 'Payment'],
            ['title' => 'Pay Final Payment', 'due' => 'December 17', 'type' => 'Payment'],
            ['title' => 'Confirm Menu with Caterer', 'due' => 'December 10', 'type' => 'Vendor'],
            ['title' => 'Finalize Guest List', 'due' => 'December 5', 'type' => 'Guests'],
            ['title' => 'Arrange Transportation', 'due' => 'December 12', 'type' => 'Logistics'],
        ];
        $this->doneTasks = 2;
        $this->totalTasks = 20;
        $this->overdueTasks = 1;
    }

    /**
     * Mount the component
     */
    public function mount(): void
    {
        $this->host = Auth::guard('host')->user();
        $this->weddingDate = $this->host->wedding_date;
        $this->eventStartTime = $this->host->event_start_time ?? '10:00';
        $this->eventEndTime = $this->host->event_end_time ?? '23:00';
        $this->updateCountdown();
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
        $this->loadVendorCategories();
        $this->loadExpenseBreakdown();
        $this->loadChecklistTasks();
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

        if ($this->statusFilter !== 'all') {
            $query->where('status', $this->statusFilter);
        }

        if (!empty($this->vendorSearch)) {
            $query->whereHas('business', function ($q) {
                $q->where('company_name', 'like', '%' . $this->vendorSearch . '%');
            });
        }

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
     * Load recent activity
     */
    private function loadRecentActivity(): void
    {
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

        $this->recentActivity = collect()
            ->merge($recentBookings)
            ->merge($recentGroups)
            ->values()
            ->take(8)
            ->toArray();
    }

    /**
     * Load available packages for quick booking
     */
    private function loadPackages(): void
    {
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
        $this->updateCountdown();
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
            'eventStartTime' => $this->eventStartTime,
            'eventEndTime' => $this->eventEndTime,
        ]);
    }
}
