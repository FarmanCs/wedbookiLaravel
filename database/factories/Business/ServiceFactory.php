<?php

namespace Database\Factories\Business;

use App\Models\Business\Service;
use App\Models\Vendor\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word() . ' Service',
            'description' => $this->faker->text(150),
            'price' => $this->faker->numberBetween(100, 2000),
            'img' => json_encode([
                $this->faker->imageUrl(600, 400, 'business'),
                $this->faker->imageUrl(600, 400, 'business'),
            ]),
            'vendor_id' => Vendor::factory(),
            'category' => $this->faker->randomElement([
                'Photography',
                'Videography',
                'Catering',
                'Decoration',
                'Music',
                'Transport',
            ]),
        ];
    }
}