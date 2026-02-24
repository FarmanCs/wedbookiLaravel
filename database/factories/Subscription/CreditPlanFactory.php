<?php

namespace Database\Factories\Subscription;

use App\Models\Subscription\CreditPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreditPlanFactory extends Factory
{
    protected $model = CreditPlan::class;

    public function definition(): array
    {
        return [
            'image' => $this->faker->optional()->imageUrl(200, 200, 'business'),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->optional()->paragraph,
            'price' => $this->faker->randomFloat(2, 20, 500),
            'discounted_percentage' => $this->faker->numberBetween(0, 50),
            'no_of_credits' => $this->faker->numberBetween(10, 1000),
        ];
    }
}