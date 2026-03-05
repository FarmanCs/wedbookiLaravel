<?php

namespace App\Livewire\Venue;

use App\Models\Business\Venue;
use App\Models\Category\Category;
use App\Models\Category\SubCategory;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

#[Layout('components.layouts.vendor.vendor')]
class VenueIndex extends Component
{
    use WithPagination;

    // Search and filter properties
    public $search = '';
    public $category = '';
    public $subcategory = '';
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

    // Sync filters with URL query string
    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
        'subcategory' => ['except' => ''],
        'country' => ['except' => ''],
        'city' => ['except' => ''],
        'min_capacity' => ['except' => ''],
        'max_capacity' => ['except' => ''],
        'min_price' => ['except' => ''],
        'max_price' => ['except' => ''],
        'sort_by' => ['except' => 'created_at'],
        'sort_order' => ['except' => 'desc'],
    ];

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        // Optionally initialize from request (Livewire handles via queryString)
    }

    public function resetFilters()
    {
        $this->reset([
            'search',
            'category',
            'subcategory',
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

    public function updatedCategory()
    {
        $this->subcategory = ''; // Reset subcategory when category changes
        $this->resetPage();
    }

    public function updatedSubcategory()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedCountry()
    {
        $this->city = ''; // Reset city when country changes
        $this->resetPage();
    }

    public function updatedCity()
    {
        $this->resetPage();
    }

    public function updatedMinCapacity()
    {
        $this->resetPage();
    }

    public function updatedMaxCapacity()
    {
        $this->resetPage();
    }

    public function updatedMinPrice()
    {
        $this->resetPage();
    }

    public function updatedMaxPrice()
    {
        $this->resetPage();
    }

    public function updatedSortBy()
    {
        $this->resetPage();
    }

    public function updatedSortOrder()
    {
        $this->resetPage();
    }

    /**
     * Build the base query with all active filters.
     */
    private function buildQuery(): Builder
    {
        $query = Venue::where('status', 'active')
            ->with('vendor'); // Eager load for efficiency

        // Text search across venue fields and vendor name
        if (!empty($this->search)) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")
                    ->orWhere('state', 'like', "%{$search}%")
                    ->orWhere('country', 'like', "%{$search}%")
                    ->orWhere('street', 'like', "%{$search}%")
                    ->orWhereHas('vendor', function ($vendorQuery) use ($search) {
                        $vendorQuery->where('full_name', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by vendor's category
        if (!empty($this->category)) {
            $query->whereHas('vendor', function ($q) {
                $q->where('category_id', $this->category);
            });
        }

        // Filter by vendor's subcategory (requires joining through businesses? 
        // Since Vendor doesn't have direct subcategory, we'll leave this commented 
        // unless you have a different logic. For now, we ignore subcategory filter.
        // If you want to filter by subcategory via Business, you can add later.

        // Country filter
        if (!empty($this->country)) {
            $query->where('country', $this->country);
        }

        // City filter
        if (!empty($this->city)) {
            $query->where('city', $this->city);
        }

        // Capacity range
        if (!empty($this->min_capacity)) {
            $query->where('capacity', '>=', (int)$this->min_capacity);
        }
        if (!empty($this->max_capacity)) {
            $query->where('capacity', '<=', (int)$this->max_capacity);
        }

        // Price range
        if (!empty($this->min_price)) {
            $query->where('price', '>=', (int)$this->min_price);
        }
        if (!empty($this->max_price)) {
            $query->where('price', '<=', (int)$this->max_price);
        }

        // Sorting
        if (in_array($this->sort_by, ['created_at', 'price', 'capacity', 'name'])) {
            $query->orderBy($this->sort_by, $this->sort_order);
        }

        return $query;
    }

    /**
     * Get paginated venues.
     */
    public function getVenuesProperty()
    {
        return $this->buildQuery()->paginate(12);
    }

    /**
     * Get total count of venues matching current filters.
     */
    public function getVenueCountProperty()
    {
        return $this->buildQuery()->count();
    }

    /**
     * Get all categories for filter dropdown/chips.
     */
    public function getCategoriesProperty()
    {
        return Category::orderBy('type')->get();
    }

    /**
     * Get subcategories based on selected category.
     */
    public function getSubcategoriesProperty()
    {
        if (empty($this->category)) {
            return collect();
        }
        return SubCategory::where('category_id', $this->category)
            ->orderBy('type')
            ->get();
    }

    /**
     * Get unique countries from active venues.
     */
    public function getCountriesProperty()
    {
        return Venue::where('status', 'active')
            ->select('country')
            ->distinct()
            ->orderBy('country')
            ->pluck('country');
    }

    /**
     * Get unique cities (optionally filtered by selected country).
     */
    public function getCitiesProperty()
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

    public function render()
    {
        return view('livewire.venue.venue-index', [
            'venues' => $this->venues,
            'venueCount' => $this->venueCount,
            'categories' => $this->categories,
            'subcategories' => $this->subcategories,
            'countries' => $this->countries,
            'cities' => $this->cities,
        ]);
    }
}
