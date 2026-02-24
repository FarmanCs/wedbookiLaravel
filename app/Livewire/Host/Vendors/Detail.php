<?php

namespace App\Livewire\Host\Vendors;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use App\Models\Vendor\Business;
use App\Models\Host\Favourites;

#[Layout('components.layouts.host.host')]
#[Title('Vendor Details')]
class Detail extends Component
{
    public $business;
    public $isFavourite;
    public $activeTab = 'about';

    public function mount($business):void
    {
        // Find the business by ID
        $this->business = Business::with(['vendor', 'packages', 'reviews', 'category', 'subcategory'])
            ->withCount(['packages', 'reviews'])
            ->findOrFail($business);

        // Check if it's in favorites
        $this->checkFavourite();
    }

    public function checkFavourite()
    {
        $hostId = Auth::guard('host')->id();
        $this->isFavourite = Favourites::where('host_id', $hostId)
            ->where('business_id', $this->business->id)
            ->exists();
    }

    public function toggleFavourite()
    {
        $hostId = Auth::guard('host')->id();

        $favourite = Favourites::where('host_id', $hostId)
            ->where('business_id', $this->business->id)
            ->first();

        if ($favourite) {
            $favourite->delete();
            $this->isFavourite = false;
        } else {
            Favourites::create([
                'host_id' => $hostId,
                'business_id' => $this->business->id,
            ]);
            $this->isFavourite = true;
        }
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.host.vendors.detail');
    }
}
