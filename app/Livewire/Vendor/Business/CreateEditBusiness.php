<?php

namespace App\Livewire\Vendor\Business;

use App\Models\Business\Business;
use App\Models\Category\Category;
use App\Models\Category\SubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;


#[Layout('components.layouts.vendor.vendor')]

class CreateEditBusiness extends Component
{
    use WithFileUploads;

    // Model and editing
    public ?Business $business = null;
    public bool $isEditing = false;

    // Form fields - ✅ FIXED: All nullable string properties
    #[Validate('required|string|max:255')]
    public string $company_name = '';

    #[Validate('required|string|max:1000')]
    public string $business_desc = '';

    #[Validate('required|integer')]
    public ?int $category_id = null;

    #[Validate('nullable|integer')]
    public ?int $subcategory_id = null;

    #[Validate('nullable|url')]
    public string $website = '';

    #[Validate('required|email')]
    public string $business_email = '';

    #[Validate('required|string|max:20')]
    public string $business_phone = '';

    #[Validate('required|string|max:255')]
    public string $street_address = '';

    #[Validate('required|string|max:100')]
    public string $city = '';

    #[Validate('required|string|max:100')]
    public string $country = '';

    #[Validate('nullable|string|max:20')]
    public string $postal_code = '';

    #[Validate('nullable|integer|min:1')]
    public ?int $capacity = null;

    #[Validate('nullable|array')]
    public array $features = [];

    #[Validate('nullable|array')]
    public array $services = [];

    // File uploads
    public $profile_image = null;
    public $cover_image = null;

    // Existing images (for editing)
    public ?string $existing_profile_image = null;
    public ?string $existing_cover_image = null;

    // UI State
    public array $categories = [];
    public array $subcategories = [];
    public string $currentStep = 'basic';
    public bool $showSuccess = false;

    // Feature/Service inputs
    public string $newFeature = '';
    public string $newService = '';

    public function mount(Business $business = null)
    {
        $vendor = Auth::guard('vendor')->user();

        if (!$vendor) {
            return redirect()->route('vendor.login');
        }

        // Load categories
        $this->categories = Category::all()->toArray();

        if ($business && $business->vendor_id === $vendor->id) {
            // Editing mode
            $this->isEditing = true;
            $this->business = $business;

            // Populate form with existing data
            $this->company_name = $business->company_name ?? '';
            $this->business_desc = $business->business_desc ?? '';
            $this->category_id = $business->category_id;
            $this->subcategory_id = $business->subcategory_id;
            $this->website = $business->website ?? '';
            $this->business_email = $business->business_email ?? '';
            $this->business_phone = $business->business_phone ?? '';
            $this->street_address = $business->street_address ?? '';
            $this->city = $business->city ?? '';
            $this->country = $business->country ?? '';
            $this->postal_code = $business->postal_code ?? '';
            $this->capacity = $business->capacity;

            // Handle features and services - decode from JSON if needed
            $this->features = is_array($business->features)
                ? $business->features
                : (is_string($business->features) ? json_decode($business->features, true) ?? [] : []);

            $this->services = is_array($business->services)
                ? $business->services
                : (is_string($business->services) ? json_decode($business->services, true) ?? [] : []);

            // Store existing images
            $this->existing_profile_image = $business->profile_image;
            $this->existing_cover_image = $business->cover_image;

            // Load subcategories if category is set
            if ($this->category_id) {
                $this->updateSubcategories();
            }
        }
    }

    public function updatedCategoryId()
    {
        $this->subcategory_id = null;
        $this->updateSubcategories();
    }

    public function updateSubcategories()
    {
        if ($this->category_id) {
            $this->subcategories = SubCategory::where('category_id', $this->category_id)
                ->get()
                ->toArray();
        } else {
            $this->subcategories = [];
        }
    }

    public function addFeature()
    {
        if (trim($this->newFeature) === '') {
            return;
        }

        if (!in_array($this->newFeature, $this->features)) {
            $this->features[] = $this->newFeature;
        }

        $this->newFeature = '';
    }

    public function removeFeature($index)
    {
        unset($this->features[$index]);
        $this->features = array_values($this->features);
    }

    public function addService()
    {
        if (trim($this->newService) === '') {
            return;
        }

        if (!in_array($this->newService, $this->services)) {
            $this->services[] = $this->newService;
        }

        $this->newService = '';
    }

    public function removeService($index)
    {
        unset($this->services[$index]);
        $this->services = array_values($this->services);
    }

    public function nextStep()
    {
        $this->validate([
            'company_name' => 'required|string|max:255',
            'business_desc' => 'required|string|max:1000',
            'category_id' => 'required|integer',
        ]);

        $this->currentStep = 'contact';
    }

    public function previousStep()
    {
        $this->currentStep = 'basic';
    }

    public function save()
    {
        $this->validate();

        $vendor = Auth::guard('vendor')->user();

        try {
            // Handle file uploads
            $profileImagePath = $this->existing_profile_image;
            $coverImagePath = $this->existing_cover_image;

            if ($this->profile_image) {
                if ($profileImagePath) {
                    Storage::disk('public')->delete($profileImagePath);
                }
                $profileImagePath = $this->profile_image->store('businesses/profiles', 'public');
            }

            if ($this->cover_image) {
                if ($coverImagePath) {
                    Storage::disk('public')->delete($coverImagePath);
                }
                $coverImagePath = $this->cover_image->store('businesses/covers', 'public');
            }

            // Prepare data
            $data = [
                'company_name' => $this->company_name,
                'business_desc' => $this->business_desc,
                'category_id' => $this->category_id,
                'subcategory_id' => $this->subcategory_id,
                'website' => $this->website ?: null,
                'business_email' => $this->business_email,
                'business_phone' => $this->business_phone,
                'street_address' => $this->street_address,
                'city' => $this->city,
                'country' => $this->country,
                'postal_code' => $this->postal_code ?: null,
                'capacity' => $this->capacity,
                'features' => !empty($this->features) ? json_encode($this->features) : null,
                'services' => !empty($this->services) ? json_encode($this->services) : null,
                'profile_image' => $profileImagePath,
                'cover_image' => $coverImagePath,
            ];

            if ($this->isEditing && $this->business) {
                // Update existing business
                $this->business->update($data);
                $message = 'Business updated successfully!';
            } else {
                // Create new business
                $data['vendor_id'] = $vendor->id;
                Business::create($data);
                $message = 'Business created successfully!';
            }

            $this->showSuccess = true;
            $this->dispatch('businessSaved');

            // Redirect after 2 seconds
            $this->js('setTimeout(() => window.location.href = "' . route('vendor.business.index') . '", 1500)');
        } catch (\Exception $e) {
            $this->addError('general', 'Error saving business: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.vendor.business.create-edit-business');
    }
}
