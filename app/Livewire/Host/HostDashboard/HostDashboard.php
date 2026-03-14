<?php

namespace App\Livewire\Host\HostDashboard;

use App\Models\Booking\Booking;
use App\Models\Guest\Guest;
use App\Models\Guest\GuestGroup;
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

    public function mount(): void
    {
        $this->host = Auth::guard('host')->user();
        $this->loadDashboardData();
    }

    public function loadDashboardData(): void
    {
        $this->loadVendorStats();
        $this->loadGuestStats();
        $this->loadBudgetStats();
        $this->loadRecentBookings();
        $this->loadBookedVendors();
        $this->loadGuestGroups();
        $this->loadRecentActivity();
    }

    private function loadVendorStats(): void
    {
        $this->totalVendors = Booking::where('host_id', $this->host->id)
            ->distinct('business_id')
            ->count('business_id');

        $this->confirmedVendors = Booking::where('host_id', $this->host->id)
            ->where('status', 'confirmed')
            ->distinct('business_id')
            ->count('business_id');
    }

    private function loadGuestStats(): void
    {
        // Total guests: count all guests belonging to host's guest groups
        $this->totalGuests = Guest::whereHas('guestGroups', function ($query) {
            $query->where('host_id', $this->host->id);
        })->count();

        // Responded guests: those with is_joining = true
        $this->respondedGuests = Guest::whereHas('guestGroups', function ($query) {
            $query->where('host_id', $this->host->id);
        })->where('is_joining', true)->count();
    }

    private function loadBudgetStats(): void
    {
        $eventBudget = $this->host->event_budget ?? 0;
        $this->budgetTotal = 'PKR ' . number_format($eventBudget, 0);

        $totalSpent = Booking::where('host_id', $this->host->id)
            ->whereIn('status', ['confirmed', 'completed'])
            ->sum('amount') ?? 0;

        $this->budgetSpent = 'PKR ' . number_format($totalSpent, 0);
    }

    private function loadRecentBookings(): void
    {
        $bookings = Booking::where('host_id', $this->host->id)
            ->with('business') // assuming business relationship gives vendor name
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        $this->recentBookings = $bookings->map(function ($booking, $index) {
            return [
                'id' => $booking->id,
                'booking_id' => $booking->custom_booking_id ?? $booking->id,
                'vendor' => $booking->business->name ?? 'N/A',
                'event_date' => $booking->event_date ? Carbon::parse($booking->event_date)->format('d/M/Y') : 'N/A',
                'created' => $booking->created_at->format('d/M/Y'),
                'status' => $booking->status,
                'amount' => 'Rs ' . number_format($booking->amount ?? 0, 2),
            ];
        })->toArray();
    }

    private function loadBookedVendors(): void
    {
        $bookings = Booking::where('host_id', $this->host->id)
            ->whereIn('status', ['confirmed', 'completed'])
            ->with('business')
            ->limit(6)
            ->get();

        $this->bookedVendors = $bookings->map(function ($booking) {
            return [
                'id' => $booking->id,
                'name' => $booking->business->name ?? 'Unknown Vendor',
                'category' => $booking->business->category ?? 'Uncategorized',
                'status' => $booking->status,
                'amount' => $booking->amount ?? 0,
                'date' => $booking->event_date ? Carbon::parse($booking->event_date)->format('M d, Y') : '',
            ];
        })->toArray();
    }

    private function loadGuestGroups(): void
    {
        $groups = GuestGroup::where('host_id', $this->host->id)
            ->withCount('guests')
            ->get();

        $this->guestGroups = $groups->map(function ($group) {
            return [
                'id' => $group->id,
                'name' => $group->group_name,
                'count' => $group->guests_count,
            ];
        })->toArray();
    }

    private function loadRecentActivity(): void
    {
        // Recent bookings (status changes)
        $recentBookings = Booking::where('host_id', $this->host->id)
            ->orderBy('updated_at', 'desc')
            ->limit(3)
            ->get()
            ->map(function ($booking) {
                return [
                    'action' => 'Booking ' . ($booking->business->name ?? 'vendor') . ' ' . $booking->status,
                    'time' => $booking->updated_at->diffForHumans(),
                ];
            });

        // Recent guest groups created
        $recentGroups = GuestGroup::where('host_id', $this->host->id)
            ->orderBy('created_at', 'desc')
            ->limit(2)
            ->get()
            ->map(function ($group) {
                return [
                    'action' => 'Added guest group: ' . $group->group_name,
                    'time' => $group->created_at->diffForHumans(),
                ];
            });

        $this->recentActivity = collect()
            ->merge($recentBookings)
            ->merge($recentGroups)
            ->sortByDesc('time')
            ->values()
            ->take(5)
            ->toArray();
    }

    public function refresh(): void
    {
        $this->loadDashboardData();
    }

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
        ]);
    }
}
