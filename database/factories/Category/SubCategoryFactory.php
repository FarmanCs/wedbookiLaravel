<?php

namespace Database\Factories\Category;

use App\Models\Category\Category;
use App\Models\Category\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubCategoryFactory extends Factory
{
    protected $model = SubCategory::class;

    public function definition(): array
    {
        return [
            'type'        => $this->faker->word,
            'category_id' => Category::factory(), // or use existing categories
            'description' => $this->faker->optional()->sentence,
            'image'       => $this->faker->optional()->imageUrl,
        ];
    }
}