<?php

namespace App\Livewire\Vendor;

use App\Models\Business\Business;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.vendor.vendor')]
class VendorDetail extends Component
{
    public ?Business $business = null;
    public float $averageRating = 0;
    public int $reviewsCount = 0;
    public ?float $startingPrice = null;
    public array $features = [];
    public array $packages = [];
    public array $reviews = [];
    public array $faqs = [];
    public array $portfolioImages = [];
    public array $services = [];
    public array $venues = [];

    public function mount($vendorId)
    {
        // Fetch business with all necessary relationships
        $this->business = Business::with([
            'vendor',
            'vendor.services',
            'category',
            'subCategory',
            'packages',
            'reviews.reviewer',
            'timings'
        ])->where('id', $vendorId)
            ->firstOrFail();

        // Calculate average rating
        $this->averageRating = $this->business->reviews->avg('rating') ?? 0;

        // Get reviews count
        $this->reviewsCount = $this->business->reviews->count();

        // Get starting price from packages
        $this->startingPrice = $this->business->packages->pluck('price')
            ->filter(fn($price) => is_numeric($price) && $price > 0)
            ->min();

        // Process features
        $this->features = $this->processFeaturesAsArray($this->business->features);

        // Process packages - FIXED: Direct database access
        $this->packages = $this->business->packages->map(function ($package) {
            $features = is_array($package->features)
                ? $package->features
                : json_decode($package->features, true) ?? [];

            return [
                'id' => $package->id,
                'name' => $package->name,
                'price' => (float)$package->price,
                'discount' => (float)($package->discount ?? 0),
                'discountPercentage' => (float)($package->discount_percentage ?? 0),
                'originalPrice' => (float)($package->discount ? $package->price + $package->discount : $package->price),
                'description' => $package->description,
                'features' => is_array($features) ? $features : [],
                'isPopular' => (bool)($package->is_popular ?? false),
            ];
        })->toArray();

        // Process reviews - FIXED: Proper relationship access
        $this->reviews = $this->business->reviews->map(function ($review) {
            return [
                'id' => $review->id,
                'rating' => (int)$review->rating,
                'comment' => $review->comment,
                'reviewerName' => $review->reviewer->full_name ?? 'Anonymous',
                'reviewerImage' => $review->reviewer->profile_image ?? null,
                'createdAt' => $review->created_at,
            ];
        })->take(5)->toArray();

        // Process FAQs
        $this->faqs = $this->processFeaturesAsArray($this->business->faqs);

        // Process portfolio images
        $this->portfolioImages = is_array($this->business->portfolio_images)
            ? $this->business->portfolio_images
            : (is_string($this->business->portfolio_images) ? json_decode($this->business->portfolio_images, true) ?? [] : []);

        // Process services from vendor - FIXED: Proper vendor relationship
        if ($this->business->vendor && $this->business->vendor->services) {
            $this->services = $this->business->vendor->services->map(function ($service) {
                return [
                    'id' => $service->id,
                    'name' => $service->name,
                    'description' => $service->description,
                    'price' => (float)$service->price,
                    'img' => $service->img,
                ];
            })->toArray();
        }
    }

    /**
     * Safely decode features/FAQs JSON to array
     */
    private function processFeaturesAsArray($data): array
    {
        if (is_array($data)) {
            return $data;
        }

        if (is_string($data)) {
            $decoded = json_decode($data, true);
            return is_array($decoded) ? $decoded : [];
        }

        return [];
    }

    /**
     * Get business initials for avatar
     */
    public function getInitials(): string
    {
        if (!$this->business) return 'BZ';

        $name = $this->business->company_name ?? 'Business';
        $words = explode(' ', trim($name));
        if (count($words) >= 2) {
            return strtoupper(substr($words[0], 0, 1) . substr(end($words), 0, 1));
        }
        return strtoupper(substr($name, 0, 2));
    }

    /**
     * Format currency
     */
    public function formatPrice($price): string
    {
        return 'Rs ' . number_format($price, 0);
    }

    public function openBookingModal($type, $id)
    {
        // Target the modal component by its name
        $this->dispatch('openBookingModal', type: $type, id: $id)
            ->to('booking.booking-modal');
    }

    /**
     * Get rating stars display
     */
    public function getStarArray(): array
    {
        $stars = [];
        for ($i = 1; $i <= 5; $i++) {
            $stars[] = [
                'filled' => $i <= floor($this->averageRating),
                'half' => $i === ceil($this->averageRating) && fmod($this->averageRating, 1) > 0,
            ];
        }
        return $stars;
    }

    public function render()
    {
        return view('livewire.vendor.vendor-detail', [
            'business' => $this->business,
            'averageRating' => $this->averageRating,
            'reviewsCount' => $this->reviewsCount,
            'startingPrice' => $this->startingPrice,
            'features' => $this->features,
            'packages' => $this->packages,
            'reviews' => $this->reviews,
            'faqs' => $this->faqs,
            'portfolioImages' => $this->portfolioImages,
            'services' => $this->services,
            'initials' => $this->getInitials(),
            'starArray' => $this->getStarArray(),
        ]);
    }
}
