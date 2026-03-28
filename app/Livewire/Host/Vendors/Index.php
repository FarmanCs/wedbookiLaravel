<?php

namespace App\Livewire\Host\Vendors;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Category\Category;
use App\Models\Booking\Booking;

#[Layout('components.layouts.host.host')]
#[Title('Vendors Management')]
class Index extends Component
{
    public $host;
    public $categories = [];
    public $search = '';

    public function mount()
    {
        $this->host = Auth::guard('host')->user();
        $this->loadCategories();
    }

    public function loadCategories()
    {
        // All categories with business count
        $allCategories = Category::withCount('businesses')->get();

        // Host's confirmed/completed bookings
        $bookings = Booking::where('host_id', $this->host->id)
            ->whereIn('status', ['confirmed', 'completed'])
            ->with('business.category')
            ->get();

        $this->categories = [];
        foreach ($allCategories as $category) {
            // Filter bookings for this category
            $categoryBookings = $bookings->filter(function ($booking) use ($category) {
                return $booking->business && $booking->business->category_id == $category->id;
            });

            // Unique hired vendors
            $hiredVendors = $categoryBookings->unique('business_id')->map(function ($booking) {
                return [
                    'id' => $booking->business->id,
                    'name' => $booking->business->company_name,
                    'avatar' => $booking->business->profile_image,
                ];
            })->values()->toArray();

            $hiredCount = count($hiredVendors);
            $totalCount = $category->businesses_count ?? 0;

            // Filter by search term (category name)
            if (!empty($this->search) && !str_contains(strtolower($category->name), strtolower($this->search))) {
                continue;
            }

            $this->categories[] = [
                'id' => $category->id,
                'name' => $category->name,
                'icon' => $this->getIconForCategory($category->name),
                'hired_count' => $hiredCount,
                'total_count' => $totalCount,
                'hired_vendors' => $hiredVendors,
            ];
        }
    }

    protected function getIconForCategory($categoryName)
    {
        $map = [
            'Cakes And Bakes' => 'cake',
            'Catering' => 'utensils',
            'Décor' => 'sparkles',
            'Entertainment' => 'music',
            'Event Planning' => 'calendar',
            'Flowers' => 'flower',
            'Hairstylist' => 'scissors',
            'Henna Artists' => 'palette',
            'Jewelry & Accessories' => 'diamond',
            'Makeup Artists' => 'brush',
            'Marquee' => 'tent',
            'Music' => 'headphones',
            'Photography And Videography' => 'camera',
            'Venue' => 'building',
            'Wedding Attire' => 'tshirt',
            'Transportation' => 'car',
            'Carts And Stalls' => 'cart',
        ];
        return $map[$categoryName] ?? 'store';
    }

    public function updatedSearch()
    {
        $this->loadCategories();
    }

    public function render()
    {
        return view('livewire.host.vendors.index');
    }
}
