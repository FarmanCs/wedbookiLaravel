<?php

namespace App\Livewire\Host\Vendors;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Title;
use Illuminate\Support\Str;

#[Layout('components.layouts.host.host')]
#[Title('Category Detail')]
class CategoryPage extends Component
{
    #[Url]
    public $category;

    #[Url]
    public $country = 'all';

    #[Url]
    public $sort = 'featured';

    public $categoryName;
    public $subcategories = [];
    public $vendors = [];

    public function mount($category)
    {
        $this->loadCategoryData($category);
    }

    protected function loadCategoryData($categorySlug)
    {
        // Map slugs to category data
        $categories = [
            'hair-stylist' => [
                'name' => 'Hair Stylist',
                'description' => 'Find the best hair stylists for your wedding',
                'subcategories' => [
                    'Bridal Hairstyling', 'Bridal Party Styling', 'Traditional Hairstyles',
                    'Modern Hairstyles', 'Hair Accessories', 'Trial Sessions'
                ],
                'icon' => 'scissors'
            ],
            'henna-artists' => [
                'name' => 'Henna Artists',
                'description' => 'Find the best henna artists for your wedding',
                'subcategories' => [
                    'Bridal Henna', 'Traditional Designs', 'Contemporary Designs',
                    'Mehndi Party', 'Henna Tattoos'
                ],
                'icon' => 'paint-brush'
            ],
            'makeup-artists' => [
                'name' => 'Makeup Artists',
                'description' => 'Find the best makeup artists for your wedding',
                'subcategories' => [
                    'Bridal Makeup', 'Airbrush Makeup', 'Traditional Makeup',
                    'Glam Makeup', 'Natural Makeup', 'Makeup Trial'
                ],
                'icon' => 'palette'
            ],
            'car-rentals' => [
                'name' => 'Car Rentals',
                'description' => 'Find the best car rentals services for your wedding',
                'subcategories' => [
                    'Luxury Cars', 'Vintage Cars', 'Limousines', 'Classic Cars', 'SUV Rentals',
                    'Convertibles', 'Wedding Car Packages', 'Chauffeur Services'
                ],
                'icon' => 'car'
            ],
            'caterers' => [
                'name' => 'Caterers',
                'description' => 'Find the best catering services for your wedding',
                'subcategories' => [
                    'Wedding Cakes', 'Buffet Services', 'Plated Dinners', 'Cocktail Receptions',
                    'Vegetarian Options', 'Vegan Catering', 'Dessert Tables', 'Beverage Services'
                ],
                'icon' => 'cake'
            ],
            'decor' => [
                'name' => 'Decor',
                'description' => 'Find the best wedding decor services',
                'subcategories' => [
                    'Floral Decor', 'Lighting', 'Table Settings', 'Backdrops',
                    'Ceiling Decor', 'Entrance Decor', 'Stage Decor'
                ],
                'icon' => 'decor'
            ],
            'florists' => [
                'name' => 'Florists',
                'description' => 'Find the best florists for your wedding flowers',
                'subcategories' => [
                    'Bridal Bouquets', 'Ceremony Flowers', 'Reception Flowers',
                    'Table Centerpieces', 'Flower Walls', 'Floral Installations'
                ],
                'icon' => 'flower'
            ],
            'photographers' => [
                'name' => 'Photographers',
                'description' => 'Find the best photographers for your wedding',
                'subcategories' => [
                    'Pre-Wedding Shoots', 'Wedding Day Coverage', 'Candid Photography',
                    'Traditional Photography', 'Drone Photography', 'Photo Albums'
                ],
                'icon' => 'camera'
            ],
            // Add more categories as needed
            'marquee' => [
                'name' => 'Marquee',
                'description' => 'Find the best marquee services for your wedding',
                'subcategories' => [
                    'Traditional Marquees', 'Clear Span Marquees', 'Stretch Tents',
                    'Marquee Flooring', 'Marquee Heating/Cooling'
                ],
                'icon' => 'home'
            ],
            'invites-signage' => [
                'name' => 'Invites & Signage',
                'description' => 'Find the best invitation and signage services',
                'subcategories' => [
                    'Wedding Invitations', 'Save the Dates', 'RSVP Cards',
                    'Welcome Signs', 'Table Numbers', 'Directional Signs'
                ],
                'icon' => 'envelope'
            ],
            'jewellery-accessories' => [
                'name' => 'Jewellery & Accessories',
                'description' => 'Find the best jewellery and accessories for your wedding',
                'subcategories' => [
                    'Bridal Jewellery', 'Hair Accessories', 'Veils',
                    'Grooms Accessories', 'Bridal Shoes', 'Handbags'
                ],
                'icon' => 'sparkles'
            ],
            'entertainment' => [
                'name' => 'Entertainment',
                'description' => 'Find the best entertainment for your wedding',
                'subcategories' => [
                    'Live Bands', 'DJs', 'Solo Musicians',
                    'Dance Groups', 'Photo Booths', 'Fireworks'
                ],
                'icon' => 'music'
            ],
        ];

        // Set category data
        $this->categoryName = $categories[$categorySlug]['name'] ?? ucwords(str_replace('-', ' ', $categorySlug));
        $this->subcategories = $categories[$categorySlug]['subcategories'] ?? [];

        // Load dummy vendors for the category
        $this->loadVendors($categorySlug);
    }

    protected function loadVendors($categorySlug)
    {
        // Default vendor template
        $defaultVendor = [
            [
                'id' => 1,
                'name' => 'PREMIUM ' . strtoupper(str_replace('-', ' ', $categorySlug)) . ' SERVICES',
                'rating' => 4.8,
                'review_count' => 24,
                'location' => 'London, UK',
                'description' => 'Providing premium ' . str_replace('-', ' ', $categorySlug) . ' services for weddings and special events.',
                'features' => ['Professional Service', 'Custom Packages', 'Experienced Team'],
                'price' => 479.36,
                'currency' => '$',
                'response_time' => 'Responds within 24 hours',
            ],
            [
                'id' => 2,
                'name' => 'ELITE ' . strtoupper(str_replace('-', ' ', $categorySlug)) . ' EXPERIENCE',
                'rating' => 4.9,
                'review_count' => 18,
                'location' => 'Manchester, UK',
                'description' => 'Elite services delivering exceptional quality and attention to detail.',
                'features' => ['Luxury Experience', 'Personalized Service', 'Award Winning'],
                'price' => 547.84,
                'currency' => '$',
                'response_time' => 'Responds within 12 hours',
            ],
        ];

        // Dummy vendors data for specific categories
        $vendorsByCategory = [
            'car-rentals' => [
                [
                    'id' => 1,
                    'name' => 'PRESTIGE DRIVE UK',
                    'rating' => 4.8,
                    'review_count' => 24,
                    'location' => 'London, UK',
                    'description' => 'Providing elite car rental services for weddings, red-carpet events, and corporate functions with a fleet of luxury vehicles.',
                    'features' => ['Photoshoot Car Rental', 'Executive Airport Transfer', 'Luxury Wedding Car Hire'],
                    'price' => 479.36,
                    'currency' => '$',
                    'response_time' => 'Responds within 24 hours',
                ],
                // ... more car rental vendors
            ],
            // Add vendors for other categories as needed
        ];

        $this->vendors = $vendorsByCategory[$categorySlug] ?? $defaultVendor;
    }

    public function updatedCountry()
    {
        // Filter vendors by country when country changes
        $this->loadVendors($this->category);
    }

    public function updatedSort()
    {
        // Sort vendors when sort option changes
        $this->sortVendors();
    }

    protected function sortVendors()
    {
        if ($this->sort === 'price_low') {
            usort($this->vendors, fn($a, $b) => $a['price'] <=> $b['price']);
        } elseif ($this->sort === 'price_high') {
            usort($this->vendors, fn($a, $b) => $b['price'] <=> $a['price']);
        } elseif ($this->sort === 'rating') {
            usort($this->vendors, fn($a, $b) => $b['rating'] <=> $a['rating']);
        }
    }

    #[Title('Wedding Vendors')]
    public function render()
    {
        return view('livewire.host.vendors.category-page');
    }
}
