<?php

namespace App\Livewire\Vendor\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Vendor\Vendor;
use App\Models\Booking\Booking;
use Illuminate\Support\Facades\Auth;

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

    public function mount()
    {
        $this->vendor = Auth::guard('vendor')->user();
        
        if ($this->vendor) {
            $this->loadDashboardData();
        }
    }

    public function loadDashboardData()
    {
        try {
            // Load page visitors (count of unique hosts who booked)
            $this->pageVisitors = $this->vendor->bookings()
                ->distinct('host_id')
                ->count('host_id') ?? 0;

            // Load total confirmed/completed bookings
            $this->totalBookings = $this->vendor->bookings()
                ->whereIn('status', ['confirmed', 'completed'])
                ->count() ?? 0;

            // Load total revenue (sum of final_amount where fully paid)
            $this->totalRevenue = $this->vendor->bookings()
                ->whereIn('status', ['confirmed', 'completed'])
                ->where('final_paid', true)
                ->sum('final_amount') ?? 0;

            // Load social clicks (set to 0 for now - implement tracking as needed)
            $this->socialClicks = 0;

            // Load recent bookings (latest 3)
            $recentBookingsData = $this->vendor->bookings()
                ->with('host', 'business')
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();

            $this->recentBookings = $recentBookingsData
                ->map(fn($booking) => [
                    'id' => $booking->custom_booking_id ?? '#B' . str_pad($booking->id, 5, '0', STR_PAD_LEFT),
                    'created' => $booking->created_at->format('d M Y'),
                    'status' => ucfirst($booking->status),
                    'amount' => 'Rs ' . number_format($booking->final_amount ?? $booking->amount ?? 0, 2),
                    'status_color' => in_array($booking->status, ['confirmed', 'completed']) ? 'green' : 'red',
                ])
                ->toArray();

            // Load reviews (if you have a reviews table in the future)
            // For now, creating empty array - uncomment when reviews table exists
            $this->reviews = [];
            /*
            $reviewsData = $this->vendor->reviews()
                ->orderBy('created_at', 'desc')
                ->take(2)
                ->get();

            $this->reviews = $reviewsData
                ->map(fn($review) => [
                    'name' => $review->reviewer_name ?? 'Anonymous',
                    'date' => $review->created_at->format('d M Y'),
                    'rating' => (int) $review->rating,
                    'comment' => $review->comment,
                    'avatar_color' => $this->getAvatarColor($review->reviewer_name ?? 'A'),
                ])
                ->toArray();
            */

            // Load credits (if field exists in vendors table)
            $this->credits = $this->vendor->credits ?? 0;

            // Load rating (when reviews table is added)
            // $this->rating = round($this->vendor->reviews()->avg('rating') ?? 0, 1);
            // $this->ratingCount = $this->vendor->reviews()->count() ?? 0;
            
            // For now, set to 0
            $this->rating = 0;
            $this->ratingCount = 0;

        } catch (\Exception $e) {
            // Log error and set defaults
          
            
            // Set all to defaults
            $this->pageVisitors = 0;
            $this->totalBookings = 0;
            $this->totalRevenue = 0;
            $this->socialClicks = 0;
            $this->recentBookings = [];
            $this->reviews = [];
            $this->credits = 0;
            $this->rating = 0;
            $this->ratingCount = 0;
        }
    }

    private function getAvatarColor($name): string
    {
        $colors = [
            'from-blue-400 to-blue-600',
            'from-red-400 to-red-600',
            'from-purple-400 to-purple-600',
            'from-pink-400 to-pink-600',
            'from-yellow-400 to-yellow-600',
            'from-green-400 to-green-600',
        ];
        
        $hash = abs(crc32($name ?? 'default'));
        return $colors[$hash % count($colors)];
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
        ]);
    }
}