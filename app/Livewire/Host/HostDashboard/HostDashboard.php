<?php

namespace App\Livewire\Host\HostDashboard;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use App\Models\Vendor\Booking;
use App\Models\Host\GuestGroup;
use App\Models\Host\HostPersonalizedChecklist;
use App\Models\Host\Checklist;
use App\Models\Vendor\Business;
use Carbon\Carbon;

#[Layout('components.layouts.host.host')]
#[Title('Dashboard')]
class HostDashboard extends Component
{
    public $host;

    // Stats
    public int $totalBookings = 0;
    public int $upcomingBookingsCount = 0;
    public int $guestGroupsCount = 0;
    public int $pendingTasksCount = 0;
    public int $favoritesCount = 0;
    public int $completedBookings = 0;

    // Collections
    public $upcomingBookings = [];
    public $pendingTasks = [];
    public $recentFavorites = [];
    public $recentChecklists = [];
    public $weddingTimeline = [];

    // Chart data
    public $bookingStats = [];

    public function mount(): void
    {
        $this->host = Auth::guard('host')->user();

    }

    public function render()
    {
        return view('livewire.Host.dashboard.host-dashboard');
    }
}
