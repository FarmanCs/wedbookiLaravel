<?php

namespace Database\Factories\Business;

use App\Models\Business\Business;
use App\Models\Category\Category;
use App\Models\Category\SubCategory;
use App\Models\Vendor\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class BusinessFactory extends Factory
{
    protected $model = Business::class;

    public function definition()
    {
        return [
            'company_name' => $this->faker->company,
            'business_desc' => $this->faker->optional()->paragraph,
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'subcategory_id' => SubCategory::inRandomOrder()->first()?->id ?? SubCategory::factory(),
            'vendor_id' => Vendor::factory(),
            'venue_type' => $this->faker->optional()->word,
            'member_type' => $this->faker->randomElement(['Premium', 'Standard', 'Basic', 'general']),
            'business_registration' => $this->faker->optional()->numerify('########'),
            'business_license_number' => $this->faker->optional()->numerify('########'),
            'rating' => $this->faker->randomFloat(2, 0, 5),
            'is_featured' => $this->faker->boolean,
            'business_type' => $this->faker->randomElement(['partnership', 'llc', 'corporation', 'Service', 'Product', 'Venue']),
            'website' => $this->faker->optional()->url,
            'social_links' => $this->faker->optional()->randomElements(['fb', 'ig', 'tw']),
            'postal_code' => $this->faker->postcode,
            'business_email' => $this->faker->companyEmail,
            'business_phone' => $this->faker->phoneNumber,
            'features' => $this->faker->optional()->words(3),
            'profile_verification' => 'verified',
            'services' => $this->faker->optional()->sentence,
            'faqs' => $this->faker->optional()->randomElements(['Q1? A1', 'Q2? A2']),
            'portfolio_images' => $this->faker->optional()->randomElements([$this->faker->imageUrl, $this->faker->imageUrl]),
            'videos' => $this->faker->optional()->randomElements([$this->faker->url, $this->faker->url]),
            'street_address' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'country' => $this->faker->country,
            'capacity' => $this->faker->optional()->numberBetween(10, 1000),
            'view_count' => 0,
            'social_count' => 0,
            'last_login' => null,
            'payment_days_advance' => 7,
            'payment_days_final' => 1,
            'services_radius' => 50,
            'advance_percentage' => 10,
            'profile_image' => null,
            'cover_image' => null,
            'chat_image' => null,
            'chat_video' => null,
            'chat_document' => null,
        ];
    }
}