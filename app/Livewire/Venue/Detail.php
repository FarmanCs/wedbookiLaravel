<?php

namespace App\Livewire\Venue;

use App\Models\Business\Venue;
use Livewire\Component;

class Detail extends Component
{
    /**
     * The venue instance
     */
    public Venue $venue;

    /**
     * Current selected image index for the gallery
     */
    public $selectedImageIndex = 0;

    /**
     * Show enlarged image modal
     */
    public $showImageModal = false;

    /**
     * Related venues from the same city
     */
    public $relatedVenues = [];

    /**
     * Mount the component with the venue
     */
    public function mount(Venue $venue)
    {
        $this->venue = $venue;

        // Load related venues from the same city
        $this->relatedVenues = Venue::where('city', $venue->city)
            ->where('id', '!=', $venue->id)
            ->where('status', 'active')
            ->limit(3)
            ->get();
    }

    /**
     * Select an image to display
     */
    public function selectImage($index)
    {
        if (is_array($this->venue->images) && isset($this->venue->images[$index])) {
            $this->selectedImageIndex = $index;
        }
    }

    /**
     * Toggle the image modal
     */
    public function toggleImageModal()
    {
        $this->showImageModal = !$this->showImageModal;
    }

    /**
     * Get the current selected image
     */
    public function getCurrentImage()
    {
        $images = $this->venue->images ?? [];

        if (is_array($images) && isset($images[$this->selectedImageIndex])) {
            return $images[$this->selectedImageIndex];
        }

        return null;
    }

    /**
     * Check if venue has multiple images
     */
    public function hasMultipleImages()
    {
        return is_array($this->venue->images) && count($this->venue->images) > 1;
    }

    /**
     * Get available dates formatted for display
     */
    public function getFormattedDates()
    {
        if (!is_array($this->venue->available_dates) || empty($this->venue->available_dates)) {
            return 'Contact venue for availability';
        }

        return implode(', ', array_map(function ($date) {
            return date('M d, Y', strtotime($date));
        }, array_slice($this->venue->available_dates, 0, 5)));
    }

    /**
     * Format timings for display
     */
    public function getFormattedTimings()
    {
        if (!is_array($this->venue->timings) || empty($this->venue->timings)) {
            return ['Morning' => 'Not available', 'Afternoon' => 'Not available', 'Evening' => 'Not available'];
        }

        return $this->venue->timings;
    }

    /**
     * Render the component
     */
    public function render()
    {
        return view('livewire.venue.detail', [
            'venue' => $this->venue,
            'relatedVenues' => $this->relatedVenues,
            'currentImage' => $this->getCurrentImage(),
            'hasMultipleImages' => $this->hasMultipleImages(),
            'formattedDates' => $this->getFormattedDates(),
            'formattedTimings' => $this->getFormattedTimings(),
        ]);
    }
}
