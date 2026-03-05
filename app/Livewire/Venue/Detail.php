<?php

namespace App\Livewire\Venue;

use App\Models\Business\Venue;
use App\Models\Booking\Review;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Carbon\Carbon;

#[Layout('components.layouts.vendor.vendor')]
class Detail extends Component
{
    public Venue $venue;
    public $selectedImageIndex = 0;
    public $showImageModal = false;
    public $relatedVenues;
    public $vendor;
    public $packages;
    public $services;
    public $reviews;

    public function mount(Venue $venue)
    {
        // Load venue with vendor
        $this->venue = $venue->load('vendor');

        $this->vendor = $this->venue->vendor;

        if ($this->vendor) {
            // Load packages and services
            $this->packages = $this->vendor->packages;
            $this->services = $this->vendor->services;

            // Get reviews from all businesses of this vendor
            $businessIds = $this->vendor->businesses()->pluck('id');
            $this->reviews = Review::whereIn('business_id', $businessIds)
                ->with('host')  // Assuming 'host' relation exists on Review
                ->latest()
                ->take(5)
                ->get();
        }

        // Related venues from same city, excluding current
        $this->relatedVenues = Venue::where('city', $venue->city)
            ->where('id', '!=', $venue->id)
            ->where('status', 'active')
            ->limit(3)
            ->get();
    }

    public function selectImage($index)
    {
        if (is_array($this->venue->images) && isset($this->venue->images[$index])) {
            $this->selectedImageIndex = $index;
        }
    }

    public function toggleImageModal()
    {
        $this->showImageModal = !$this->showImageModal;
    }

    public function getCurrentImage()
    {
        $images = $this->venue->images ?? [];
        if (is_array($images) && isset($images[$this->selectedImageIndex])) {
            return $images[$this->selectedImageIndex];
        }
        return null;
    }

    public function hasMultipleImages()
    {
        return is_array($this->venue->images) && count($this->venue->images) > 1;
    }

    public function getFormattedDates()
    {
        if (!is_array($this->venue->available_dates) || empty($this->venue->available_dates)) {
            return 'Contact venue for availability';
        }

        return collect(array_slice($this->venue->available_dates, 0, 5))
            ->map(fn($date) => Carbon::parse($date)->format('M d, Y'))
            ->implode(', ');
    }

    public function getFormattedTimings()
    {
        if (!is_array($this->venue->timings) || empty($this->venue->timings)) {
            return [
                'Monday - Friday' => '9:00 AM - 6:00 PM',
                'Saturday'       => '10:00 AM - 4:00 PM',
                'Sunday'         => 'Closed',
            ];
        }

        return $this->venue->timings;
    }

    public function render()
    {
        return view('livewire.venue.detail', [
            'venue'             => $this->venue,
            'vendor'            => $this->vendor,
            'packages'          => $this->packages ?? collect(),
            'services'          => $this->services ?? collect(),
            'reviews'           => $this->reviews ?? collect(),
            'relatedVenues'     => $this->relatedVenues,
            'currentImage'      => $this->getCurrentImage(),
            'hasMultipleImages' => $this->hasMultipleImages(),
            'formattedDates'    => $this->getFormattedDates(),
            'formattedTimings'  => $this->getFormattedTimings(),
        ]);
    }
}
