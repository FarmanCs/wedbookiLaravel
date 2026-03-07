<?php

namespace App\Livewire\Vendor\Business;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.vendor.vendor')]
class VendorBusiness extends Component
{
    public $businesses;

    public function mount()
    {
        $vendor = Auth::guard('vendor')->user();


        if (!$vendor) {
            return redirect()->route('vendor.login');
        }

        $this->businesses = $vendor->businesses()
            ->withCount(['packages', 'bookings', 'reviews'])
            ->withAvg('reviews', 'points')
            ->with([
                'category',
                'subCategory',
                'packages' => fn($q) => $q->orderBy('price')->take(5),
                'timings',
                'reviews' => fn($q) => $q->with('host')->latest()->take(5),
                'bookings' => fn($q) => $q->with('host')->latest()->take(5),
            ])
            ->get();
    }

    public function render()
    {
        return view('livewire.vendor.business.vendor-business');
    }
}
