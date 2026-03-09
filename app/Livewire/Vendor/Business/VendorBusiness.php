<?php

namespace App\Livewire\Vendor\Business;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

#[Layout('components.layouts.vendor.vendor')]
class VendorBusiness extends Component
{
    public $businesses;
    public $showDeleteSuccess = false;
    public $deletedBusinessName = '';

    public function mount()
    {
        $this->loadBusinesses();
    }

    public function loadBusinesses()
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

    public function delete($id)
    {
        $vendor = Auth::guard('vendor')->user();
        $business = $vendor->businesses()->find($id);

        if (!$business) {
            $this->addError('delete', 'Business not found.');
            return;
        }

        // Delete images from storage
        if ($business->profile_image) {
            Storage::disk('public')->delete($business->profile_image);
        }
        if ($business->cover_image) {
            Storage::disk('public')->delete($business->cover_image);
        }

        $businessName = $business->company_name;
        $business->delete();

        $this->loadBusinesses();
        $this->showDeleteSuccess = true;
        $this->deletedBusinessName = $businessName;
    }

    public function render()
    {
        return view('livewire.vendor.business.vendor-business');
    }
}
