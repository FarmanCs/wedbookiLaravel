<?php

namespace Database\Factories\Feature;

use App\Models\Feature\AdminPackage;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminPackageFactory extends Factory
{
    protected $model = AdminPackage::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->optional()->paragraph,
            'badge' => $this->faker->optional()->word,
            'monthly_price' => $this->faker->randomFloat(2, 10, 100),
            'quarterly_price' => $this->faker->randomFloat(2, 25, 250),
            'yearly_price' => $this->faker->randomFloat(2, 80, 800),
            'category_id' => \App\Models\Category\Category::inRandomOrder()->first()?->id
                ?? \App\Models\Category\Category::factory(),
            'is_active' => $this->faker->boolean(80),
            'published_at' => $this->faker->optional()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}