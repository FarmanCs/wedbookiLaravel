<?php

namespace Database\Factories\Business;

use App\Models\Business\Business;
use App\Models\Business\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

class PackageFactory extends Factory
{
    protected $model = Package::class;

    public function definition(): array
    {
        $price = $this->faker->numberBetween(500, 5000);
        $discount = $this->faker->numberBetween(0, 500);

        return [
            'business_id' => Business::factory(),
            'name' => $this->faker->word() . ' Package',
            'price' => $price,
            'discount' => $discount,
            'discount_percentage' => ($discount / $price) * 100,
            'description' => $this->faker->text(150),
            'features' => json_encode([
                'Feature 1',
                'Feature 2',
                'Feature 3',
                'Feature 4',
            ]),
            'is_popular' => $this->faker->boolean(),
        ];
    }
}