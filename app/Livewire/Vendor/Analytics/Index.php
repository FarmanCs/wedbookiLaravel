<?php

namespace App\Livewire\Vendor\Analytics;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Analytics\BusinessView;
use App\Models\Analytics\BusinessSocialClick;
use App\Models\Booking\Review;
use App\Models\Business\Business;

#[Layout('components.layouts.vendor.vendor')]
class Index extends Component
{
    public $businesses;
    public $totalViews = 0;
    public $totalClicks = 0;
    public $avgRating = 0;
    public $totalReviews = 0;
    public $viewsOverTime = [];
    public $clicksByPlatform = [];
    public $recentReviews;

    public function mount()
    {
        $vendor = Auth::guard('vendor')->user();
        if (!$vendor) {
            return redirect()->route('vendor.login');
        }

        // Get all businesses owned by this vendor
        $this->businesses = Business::where('vendor_id', $vendor->id)->get();
        $businessIds = $this->businesses->pluck('id');

        if ($businessIds->isEmpty()) {
            return;
        }

        // Total views from BusinessView table
        $this->totalViews = BusinessView::whereIn('business_id', $businessIds)->count();

        // Total social clicks
        $this->totalClicks = BusinessSocialClick::whereIn('business_id', $businessIds)->count();

        // Average rating from Business model (or calculate from reviews)
        $this->avgRating = round($this->businesses->avg('rating'), 1);

        // Total reviews count
        $this->totalReviews = Review::whereIn('business_id', $businessIds)->count();

        // Views over last 7 days
        $this->viewsOverTime = BusinessView::whereIn('business_id', $businessIds)
            ->where('viewed_at', '>=', now()->subDays(7))
            ->select(DB::raw('DATE(viewed_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date')
            ->map(fn($item) => $item->count)
            ->toArray();

        // Fill missing days with zero
        $this->viewsOverTime = collect(range(6, 0))->mapWithKeys(function ($daysAgo) {
            $date = now()->subDays($daysAgo)->toDateString();
            return [$date => $this->viewsOverTime[$date] ?? 0];
        })->toArray();

        // Clicks grouped by platform
        $this->clicksByPlatform = BusinessSocialClick::whereIn('business_id', $businessIds)
            ->select('platform', DB::raw('count(*) as count'))
            ->groupBy('platform')
            ->orderByDesc('count')
            ->get()
            ->toArray();

        // 5 most recent reviews with business name
        $this->recentReviews = Review::whereIn('business_id', $businessIds)
            ->with('business:id,company_name')
            ->latest()
            ->limit(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.vendor.analytics.index');
    }
}
