<?php

namespace App\Livewire\Vendor\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.vendor.vendor')]
class VendorDashboard extends Component
{
    public $pageVisitors = 3;
    public $totalBookings = 3;
    public $totalRevenue = 645729895.32;
    public $socialClicks = 0;
    public $availableCredits = 780;

    public $recentBookings = [];
    public $latestReviews = [];

    public function mount()
    {
        // Static data for recent bookings
        $this->recentBookings = [
            [
                'id' => '#WB-B40071',
                'event_date' => 'N/A',
                'created' => '27 Aug 2025',
                'package' => '—',
                'status' => 'Confirmed',
                'amount' => 49040361.44
            ],
            [
                'id' => '#WB-B40068',
                'event_date' => 'N/A',
                'created' => '27 Aug 2025',
                'package' => '—',
                'status' => 'Confirmed',
                'amount' => 297104446.54
            ],
            [
                'id' => '#WB-B40069',
                'event_date' => 'N/A',
                'created' => '27 Aug 2025',
                'package' => '—',
                'status' => 'Cancelled',
                'amount' => 298249357.70
            ],
        ];

        // Static data for reviews
        $this->latestReviews = [
            [
                'name' => 'Hanzala Khalid',
                'date' => '8 Sept 2025',
                'rating' => 4,
                'review' => 'The vendor is nice! will book again for second wedding',
                'avatar' => null
            ],
            [
                'name' => 'Ali Zahi',
                'date' => '3 Sept 2025',
                'rating' => 5,
                'review' => 'From start to finish, the service was nothing short of impeccable, surpassing all expectations in every possible way. Every detail was meticulously organized, ensuring a seamless, efficient, and completely stress-free experience.',
                'avatar' => null
            ],
            [
                'name' => 'Anonymous',
                'date' => '18 Aug 2025',
                'rating' => 5,
                'review' => 'I recently hosted my event at The Grand Horizon Venue, and the experience was nothing short of amazing. The staff was professional, the décor was stunning, and every detail was taken care of with perfection. My guests were...',
                'avatar' => null
            ],
        ];
    }

    public function render()
    {
        return view('livewire.vendor.dashboard.vendor-dashboard');
    }
}
