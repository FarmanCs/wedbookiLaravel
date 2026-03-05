<?php

namespace App\Livewire\Vendor;

use App\Models\Category\Category;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.vendor.vendor')]
class WeddingVendors extends Component
{
    public Collection $categories;

    public function mount()
    {
        // Load categories with their businesses and required relationships
        $this->categories = Category::with([
            'businesses' => function ($query) {
                $query->with([
                    'packages',
                    'reviews'
                ])->orderBy('company_name');
            }
        ])
            ->whereHas('businesses')
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

    public function render()
    {
        $groupedBusinesses = $this->categories->mapWithKeys(function ($category) {
            $businesses = $category->businesses->map(function ($business) {
                $business->avg_rating = $this->averageRating($business);
                $business->reviews_count = $this->reviewsCount($business);
                $business->starting_price = $this->startingPrice($business);
                $business->features = $this->getFeaturesAsArray($business);
                $business->initials = $this->initials($business);
                return $business;
            });

            return [$category->type => $businesses];
        });

        return view('livewire.vendor.wedding-vendors', [
            'groupedBusinesses' => $groupedBusinesses,
        ]);
    }
}
