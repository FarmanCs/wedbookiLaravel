<?php

namespace App\Livewire\Vendor\Storefront;

use App\Models\Business\Business;
use App\Models\Business\Package; // Make sure this model exists
use App\Models\Vendor\Vendor;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.vendor.vendor')]

class Index extends Component
{
    use WithFileUploads;

    public Business $business;
    public Vendor $vendor;
    public $packages = [];

    public $newFeature = '';
    public $newFaqQuestion = '';
    public $newFaqAnswer = '';
    public $newVideoUrl = '';
    public $uploadedImages = [];
    public $documents = [];

    public $newPackage = [
        'name' => '',
        'description' => '',
        'price' => null,
        'duration' => '',
    ];

    protected $rules = [
        'business.company_name' => 'nullable|string|max:255',
        'business.business_desc' => 'nullable|string|min:20',
        'business.category_id' => 'nullable|exists:categories,id',
        'business.subcategory_id' => 'nullable|exists:sub_categories,id',
        'business.business_type' => 'nullable|string',
        'business.business_registration' => 'nullable|string',
        'business.business_email' => 'nullable|email',
        'business.business_phone' => 'nullable|string',
        'business.street_address' => 'nullable|string',
        'business.city' => 'nullable|string',
        'business.country' => 'nullable|string',
        'business.postal_code' => 'nullable|string',
        'business.website' => 'nullable|url',
        'business.social_links' => 'nullable|array',
        'business.features' => 'nullable|array',
        'business.faqs' => 'nullable|array',
        'business.portfolio_images' => 'nullable|array',
        'business.videos' => 'nullable|array',
        'business.cancellation_policy' => 'nullable|string|in:flexible,moderate,strict',
    ];

    public function mount()
    {
        $this->vendor = Auth::guard('vendor')->user();
        $this->business = $this->vendor->businesses()->firstOrNew(['vendor_id' => $this->vendor->id]);

        if (!$this->business->exists) {
            $this->business->fill([
                'features' => [],
                'faqs' => [],
                'portfolio_images' => [],
                'videos' => [],
                'social_links' => [],
            ]);
        }

        $this->loadPackages();
    }

    protected function loadPackages()
    {
        if ($this->business->exists) {
            // Removed 'sort_order' – order by created_at or leave as default
            $this->packages = $this->business->packages()->orderBy('created_at')->get()->toArray();
        } else {
            $this->packages = [];
        }
    }

    public function addFeature()
    {
        $this->validate(['newFeature' => 'required|string|max:100']);
        $features = $this->business->features ?? [];
        $features[] = $this->newFeature;
        $this->business->features = $features;
        $this->newFeature = '';
    }

    public function removeFeature($index)
    {
        $features = $this->business->features ?? [];
        unset($features[$index]);
        $this->business->features = array_values($features);
    }

    public function addFaq()
    {
        $this->validate([
            'newFaqQuestion' => 'required|string|max:255',
            'newFaqAnswer' => 'required|string|max:1000',
        ]);
        $faqs = $this->business->faqs ?? [];
        $faqs[] = ['question' => $this->newFaqQuestion, 'answer' => $newFaqAnswer];
        $this->business->faqs = $faqs;
        $this->newFaqQuestion = '';
        $this->newFaqAnswer = '';
    }

    public function removeFaq($index)
    {
        $faqs = $this->business->faqs ?? [];
        unset($faqs[$index]);
        $this->business->faqs = array_values($faqs);
    }

    public function addVideo()
    {
        $this->validate(['newVideoUrl' => 'required|url']);
        $videos = $this->business->videos ?? [];
        $videos[] = $this->newVideoUrl;
        $this->business->videos = $videos;
        $this->newVideoUrl = '';
    }

    public function removeVideo($index)
    {
        $videos = $this->business->videos ?? [];
        unset($videos[$index]);
        $this->business->videos = array_values($videos);
    }

    public function updatedUploadedImages()
    {
        $this->validate(['uploadedImages.*' => 'image|max:5120']);
        foreach ($this->uploadedImages as $image) {
            $path = $image->store('business/portfolio', 'public');
            $images = $this->business->portfolio_images ?? [];
            $images[] = $path;
            $this->business->portfolio_images = $images;
        }
        $this->uploadedImages = [];
    }

    public function removeImage($imagePath)
    {
        $images = $this->business->portfolio_images ?? [];
        $images = array_filter($images, fn($img) => $img !== $imagePath);
        $this->business->portfolio_images = array_values($images);
        \Storage::disk('public')->delete($imagePath);
    }

    public function updatedDocuments()
    {
        $this->validate([
            'documents.*' => 'file|mimes:pdf,docx,doc,jpg,jpeg,png,webp|max:10240',
        ]);
        foreach ($this->documents as $doc) {
            $path = $doc->store('business/documents', 'public');
            // You can store the document reference in a separate table or JSON field
            session()->flash('message', 'Document uploaded successfully.');
        }
        $this->documents = [];
    }

    public function addPackage()
    {
        $this->validate([
            'newPackage.name' => 'required|string|max:255',
            'newPackage.description' => 'nullable|string',
            'newPackage.price' => 'nullable|numeric|min:0',
            'newPackage.duration' => 'nullable|string|max:100',
        ]);

        if (!$this->business->exists) {
            // Store temporarily
            $this->packages[] = $this->newPackage;
        } else {
            $package = $this->business->packages()->create([
                'name' => $this->newPackage['name'],
                'description' => $this->newPackage['description'],
                'price' => $this->newPackage['price'],
                'duration' => $this->newPackage['duration'],
            ]);
            $this->packages[] = $package->toArray();
        }

        $this->newPackage = ['name' => '', 'description' => '', 'price' => null, 'duration' => ''];
    }

    public function removePackage($index)
    {
        if (isset($this->packages[$index]['id'])) {
            Package::find($this->packages[$index]['id'])?->delete();
        }
        unset($this->packages[$index]);
        $this->packages = array_values($this->packages);
    }

    public function save()
    {
        $this->validate();
        if (empty($this->business->vendor_id)) {
            $this->business->vendor_id = $this->vendor->id;
        }
        $this->business->save();

        // Save any unsaved packages (when business was new)
        foreach ($this->packages as $packageData) {
            if (!isset($packageData['id'])) {
                $this->business->packages()->create([
                    'name' => $packageData['name'],
                    'description' => $packageData['description'] ?? null,
                    'price' => $packageData['price'] ?? null,
                    'duration' => $packageData['duration'] ?? null,
                ]);
            }
        }

        $this->loadPackages();
        session()->flash('message', 'Storefront saved successfully.');
    }

    public function render()
    {
        return view('livewire.vendor.storefront.index');
    }
}
