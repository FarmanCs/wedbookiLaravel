<?php

namespace App\Livewire\Venue;

use App\Models\Business\Venue;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.vendor.vendor')]
class VenueIndex extends Component
{
    use WithPagination;

    // Search and filter properties
    public $search = '';
    public $venue_type = '';
    public $country = '';
    public $city = '';
    public $min_capacity = '';
    public $max_capacity = '';
    public $min_price = '';
    public $max_price = '';
    public $sort_by = 'created_at';
    public $sort_order = 'desc';

    // UI state
    public $showFilters = false;
    public $isLoading = false;

    // Pagination
    protected $paginationTheme = 'tailwind';

    /**
     * Mount the component and initialize default values
     */
    public function mount()
    {
        // Initialize with URL query parameters if they exist
        $this->search = request('search', '');
        $this->venue_type = request('venue_type', '');
        $this->country = request('country', '');
        $this->city = request('city', '');
        $this->min_capacity = request('min_capacity', '');
        $this->max_capacity = request('max_capacity', '');
        $this->min_price = request('min_price', '');
        $this->max_price = request('max_price', '');
        $this->sort_by = request('sort_by', 'created_at');
        $this->sort_order = request('sort_order', 'desc');
    }

    /**
     * Reset all filters to their default values
     */
    public function resetFilters()
    {
        $this->reset([
            'search',
            'venue_type',
            'country',
            'city',
            'min_capacity',
            'max_capacity',
            'min_price',
            'max_price',
            'sort_by',
            'sort_order'
        ]);

        $this->resetPage();
    }

    /**
     * Update the sort option and reset pagination
     */
    public function updateSort($sortBy, $sortOrder)
    {
        $this->sort_by = $sortBy;
        $this->sort_order = $sortOrder;
        $this->resetPage();
    }

    /**
     * Toggle the filter panel visibility on mobile
     */
    public function toggleFilters()
    {
        $this->showFilters = !$this->showFilters;
    }

    /**
     * Get the total count of venues matching current filters
     */
    public function getVenueCount()
    {
        return $this->buildQuery()->count();
    }

    /**
     * Build the database query based on current filters
     */
    private function buildQuery()
    {
        $query = Venue::query();

        // Text search across multiple fields
        if (!empty($this->search)) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")
                    ->orWhere('state', 'like', "%{$search}%")
                    ->orWhere('country', 'like', "%{$search}%")
                    ->orWhere('street', 'like', "%{$search}%");
            });
        }

        // Filter by venue type
        if (!empty($this->venue_type)) {
            $query->where('venue_type', $this->venue_type);
        }

        // Filter by country
        if (!empty($this->country)) {
            $query->where('country', $this->country);
        }

        // Filter by city
        if (!empty($this->city)) {
            $query->where('city', $this->city);
        }

        // Filter by minimum capacity
        if (!empty($this->min_capacity)) {
            $query->where('capacity', '>=', (int)$this->min_capacity);
        }

        // Filter by maximum capacity
        if (!empty($this->max_capacity)) {
            $query->where('capacity', '<=', (int)$this->max_capacity);
        }

        // Filter by minimum price
        if (!empty($this->min_price)) {
            $query->where('price', '>=', (int)$this->min_price);
        }

        // Filter by maximum price
        if (!empty($this->max_price)) {
            $query->where('price', '<=', (int)$this->max_price);
        }

        // Only show active venues
        $query->where('status', 'active');

        // Apply sorting with validation to prevent SQL injection
        if (in_array($this->sort_by, ['created_at', 'price', 'capacity', 'name'])) {
            $query->orderBy($this->sort_by, $this->sort_order);
        }

        return $query;
    }

    /**
     * Get the paginated venues based on filters
     */
    public function getVenues()
    {
        return $this->buildQuery()->paginate(12);
    }

    /**
     * Get unique countries for the filter dropdown
     */
    public function getCountries()
    {
        return Venue::where('status', 'active')
            ->select('country')
            ->distinct()
            ->orderBy('country')
            ->pluck('country');
    }

    /**
     * Get cities for the selected country
     */
    public function getCities()
    {
        $query = Venue::where('status', 'active');

        if (!empty($this->country)) {
            $query->where('country', $this->country);
        }

        return $query->select('city')
            ->distinct()
            ->orderBy('city')
            ->pluck('city');
    }

    /**
     * Render the component view
     */
    public function render()
    {
        return view('livewire.venue.venue-index', [
            'venues' => $this->getVenues(),
            'countries' => $this->getCountries(),
            'cities' => $this->getCities(),
            'venueCount' => $this->getVenueCount(),
        ]);
    }
}
