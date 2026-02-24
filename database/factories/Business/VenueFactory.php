<?php

namespace Database\Factories\Business;

use App\Models\Business\Venue;
use App\Models\Vendor\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VenueFactory extends Factory
{
    protected $model = Venue::class;

    public function definition(): array
    {
        return [
            'vendor_id' => Vendor::factory(),
            'name' => $this->faker->word() . ' Venue',
            'timings' => json_encode([
                'morning' => '09:00-12:00',
                'afternoon' => '12:00-18:00',
                'evening' => '18:00-23:00',
            ]),
            'extra_services' => json_encode([
                'Decoration',
                'Catering',
                'Photography',
            ]),
            'images' => json_encode([
                $this->faker->imageUrl(800, 600),
                $this->faker->imageUrl(800, 600),
                $this->faker->imageUrl(800, 600),
            ]),
            'price' => $this->faker->numberBetween(2000, 10000),
            'street' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'country' => $this->faker->country(),
            'postal_code' => $this->faker->postcode(),
            'capacity' => $this->faker->numberBetween(50, 1000),
            'available_dates' => json_encode([
                now()->addMonth()->toDateString(),
                now()->addMonths(2)->toDateString(),
                now()->addMonths(3)->toDateString(),
            ]),
            'status' => $this->faker->randomElement(['pending', 'active', 'rejected']),
        ];
    }
}