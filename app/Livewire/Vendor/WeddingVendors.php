<?php

namespace App\Livewire\Vendor;

use App\Models\Category\Category;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.host.host')]

class WeddingVendors extends Component
{
    public Collection $categories;
    public $search = '';

    public function mount()
    {
        // Load categories with their businesses and required relationships
        $this->categories = Category::with([
            'businesses' => function ($query) {
                $query->with([
                    'packages',
                    'reviews'
                ])->where('is_active', true) // Only show active businesses
                    ->orderBy('is_featured', 'desc') // Featured first
                    ->orderBy('company_name');
            }
        ])
            ->whereHas('businesses', function ($query) {
                $query->where('is_active', true);
            })
            ->get();
    }

    /**
     * Get average rating from reviews collection.
     */
    private function averageRating($business): float
    {
        return $business->reviews->avg('rating') ?? 0;
    }

    /**
     * Get total reviews count.
     */
    private function reviewsCount($business): int
    {
        return $business->reviews->count();
    }

    /**
     * Get the lowest starting price from packages.
     */
    private function startingPrice($business): ?float
    {
        $prices = $business->packages->pluck('price')->filter(fn($price) => is_numeric($price) && $price > 0);
        return $prices->min();
    }

    /**
     * Safely decode features JSON to array.
     */
    private function getFeaturesAsArray($business): array
    {
        $features = $business->features;

        if (is_array($features)) {
            return $features;
        }

        if (is_string($features)) {
            $decoded = json_decode($features, true);
            return is_array($decoded) ? $decoded : [];
        }

        return [];
    }

    /**
     * Get business initials for avatar.
     */
    private function initials($business): string
    {
        $name = $business->company_name ?? 'Business';
        $words = explode(' ', trim($name));
        if (count($words) >= 2) {
            return strtoupper(substr($words[0], 0, 1) . substr(end($words), 0, 1));
        }
        return strtoupper(substr($name, 0, 2));
    }

    /**
     * Get the vendor detail page URL
     */
    private function vendorDetailUrl($business): string
    {
        // Use custom vendor ID if available, otherwise use business ID
        $vendorId = $business->id;

        // Optional: Create a slug from company name
        $slug = str_replace(' ', '-', strtolower($business->company_name));

        // Use your preferred URL format
        return route('vendor.detail', ['vendorId' => $vendorId]);

        // Or with slug:
        // return route('vendor.detail.slug', ['slug' => $slug, 'vendorId' => $vendorId]);
    }

    public function render()
    {
        $groupedBusinesses = $this->categories->mapWithKeys(function ($category) {
            $businesses = $category->businesses->filter(function ($business) {
                return empty($this->search) || str_contains(strtolower($business->company_name), strtolower($this->search));
            })->map(function ($business) {
                $business->avg_rating = $this->averageRating($business);
                $business->reviews_count = $this->reviewsCount($business);
                $business->starting_price = $this->startingPrice($business);
                $business->features = $this->getFeaturesAsArray($business);
                $business->initials = $this->initials($business);
                $business->detail_url = $this->vendorDetailUrl($business);
                return $business;
            });

            return [$category->type => $businesses];
        });

        return view('livewire.vendor.wedding-vendors', [
            'groupedBusinesses' => $groupedBusinesses,
        ]);
    }
}
