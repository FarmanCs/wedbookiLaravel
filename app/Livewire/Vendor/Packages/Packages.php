<?php

namespace App\Livewire\Vendor\Packages;

use Livewire\Component;
use App\Models\Business\Package;
use App\Models\Business\Business;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.vendor.vendor')]
class Packages extends Component
{
    // List and form state
    public $packages = [];
    public $businesses = [];
    public $showForm = false;
    public $editingPackage = null;

    // Form fields
    public $business_id = '';
    public $name = '';
    public $price = '';
    public $discount = '';
    public $discount_percentage = '';
    public $description = '';
    public $features = '';
    public $is_popular = false;

    // Validation rules
    protected $rules = [
        'business_id'          => 'required|exists:businesses,id',
        'name'                  => 'required|string|max:255',
        'price'                 => 'required|numeric|min:0.01',
        'discount'              => 'nullable|numeric|min:0',
        'discount_percentage'   => 'nullable|numeric|min:0|max:100',
        'description'           => 'nullable|string|max:1000',
        'features'              => 'nullable|string',
        'is_popular'            => 'boolean',
    ];

    protected $messages = [
        'business_id.required' => 'Please select a business',
        'business_id.exists' => 'The selected business is invalid',
        'name.required' => 'Package name is required',
        'name.max' => 'Package name must not exceed 255 characters',
        'price.required' => 'Price is required',
        'price.numeric' => 'Price must be a valid number',
        'price.min' => 'Price must be greater than 0',
        'discount.numeric' => 'Discount must be a valid number',
        'discount.min' => 'Discount cannot be negative',
        'discount_percentage.numeric' => 'Discount percentage must be a number',
        'discount_percentage.max' => 'Discount percentage cannot exceed 100%',
    ];

    /**
     * Mount component
     */
    public function mount()
    {
        try {
            $vendor = Auth::guard('vendor')->user();

            if (!$vendor) {
                return redirect()->route('vendor.login');
            }

            $this->loadPackages();
            $this->loadBusinesses();
        } catch (\Exception $e) {
            \Log::error('Packages mount error: ' . $e->getMessage());
            session()->flash('error', 'Failed to load page. Please refresh.');
        }
    }

    /**
     * Load packages from database
     */
    public function loadPackages()
    {
        try {
            $vendor = Auth::guard('vendor')->user();

            if (!$vendor) {
                $this->packages = [];
                return;
            }

            $businessIds = $vendor->businesses()->pluck('id')->toArray();

            $this->packages = Package::whereIn('business_id', $businessIds)
                ->with('business')
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (\Exception $e) {
            \Log::error('Error loading packages: ' . $e->getMessage());
            $this->packages = [];
        }
    }

    /**
     * Load businesses from database
     */
    public function loadBusinesses()
    {
        try {
            $vendor = Auth::guard('vendor')->user();

            if (!$vendor) {
                $this->businesses = [];
                return;
            }

            $this->businesses = $vendor->businesses()
                ->select('id', 'company_name')
                ->get()
                ->toArray();

            if (empty($this->businesses)) {
                session()->flash('error', 'Please create a business first before adding packages.');
            }
        } catch (\Exception $e) {
            \Log::error('Error loading businesses: ' . $e->getMessage());
            $this->businesses = [];
        }
    }

    /**
     * Show create form
     */
    public function create()
    {
        if (empty($this->businesses)) {
            session()->flash('error', 'Please create a business first before adding packages.');
            return;
        }

        $this->resetForm();
        $this->showForm = true;
        $this->editingPackage = null;
    }

    /**
     * Show edit form
     */
    public function edit($packageId)
    {
        try {
            $package = Package::findOrFail($packageId);
            $vendor = Auth::guard('vendor')->user();

            $vendorBusinessIds = $vendor->businesses()->pluck('id')->toArray();

            if (!in_array($package->business_id, $vendorBusinessIds)) {
                session()->flash('error', 'Unauthorized access.');
                return;
            }

            $this->editingPackage = $package->toArray();
            $this->business_id = (string)$package->business_id;
            $this->name = $package->name;
            $this->price = (string)$package->price;
            $this->discount = (string)($package->discount ?? '');
            $this->discount_percentage = (string)($package->discount_percentage ?? '');
            $this->description = $package->description ?? '';
            $this->features = is_array($package->features) ? implode("\n", $package->features) : '';
            $this->is_popular = (bool)$package->is_popular;

            $this->showForm = true;
        } catch (\Exception $e) {
            \Log::error('Edit package error: ' . $e->getMessage());
            session()->flash('error', 'Package not found.');
        }
    }

    /**
     * Save package
     */
    public function save()
    {
        try {
            $this->validate();

            $featuresArray = array_filter(
                array_map('trim', explode("\n", $this->features ?? '')),
                fn($item) => !empty($item)
            );

            $data = [
                'business_id' => (int)$this->business_id,
                'name' => trim($this->name),
                'price' => (float)$this->price,
                'discount' => (float)($this->discount ?? 0),
                'discount_percentage' => (float)($this->discount_percentage ?? 0),
                'description' => trim($this->description ?? ''),
                'features' => array_values($featuresArray),
                'is_popular' => (bool)$this->is_popular,
            ];

            if ($this->editingPackage) {
                $package = Package::findOrFail($this->editingPackage['id']);
                $vendor = Auth::guard('vendor')->user();
                $vendorBusinessIds = $vendor->businesses()->pluck('id')->toArray();

                if (!in_array($package->business_id, $vendorBusinessIds)) {
                    session()->flash('error', 'Unauthorized access.');
                    return;
                }

                $package->update($data);
                session()->flash('message', '✨ Package updated successfully! Your changes are live.');
            } else {
                Package::create($data);
                session()->flash('message', '🎉 Package created successfully! Ready to receive bookings.');
            }

            $this->resetForm();
            $this->loadPackages();
            $this->showForm = false;
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            \Log::error('Save package error: ' . $e->getMessage());
            session()->flash('error', 'Failed to save package. Please try again.');
        }
    }

    /**
     * Delete package
     */
    public function delete($packageId)
    {
        try {
            $package = Package::findOrFail($packageId);
            $vendor = Auth::guard('vendor')->user();

            $vendorBusinessIds = $vendor->businesses()->pluck('id')->toArray();

            if (!in_array($package->business_id, $vendorBusinessIds)) {
                session()->flash('error', 'Unauthorized access.');
                return;
            }

            $packageName = $package->name;
            $package->delete();

            $this->loadPackages();
            session()->flash('message', "🗑️ Package '{$packageName}' deleted successfully.");
        } catch (\Exception $e) {
            \Log::error('Delete package error: ' . $e->getMessage());
            session()->flash('error', 'Failed to delete package.');
        }
    }

    /**
     * Reset form
     */
    public function resetForm()
    {
        $this->reset([
            'business_id',
            'name',
            'price',
            'discount',
            'discount_percentage',
            'description',
            'features',
            'is_popular',
            'editingPackage'
        ]);
        $this->clearValidation();
    }

    /**
     * Cancel form
     */
    public function cancel()
    {
        $this->resetForm();
        $this->showForm = false;
    }

    /**
     * Render view
     */
    public function render()
    {
        return view('livewire.vendor.packages.packages', [
            'packages' => $this->packages,
            'businesses' => $this->businesses,
            'showForm' => $this->showForm,
            'editingPackage' => $this->editingPackage,
        ]);
    }
}
