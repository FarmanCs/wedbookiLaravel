<?php

namespace Database\Factories\Category;

use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $categories = [
            'Photographers',
            'Videographers',
            'Makeup Artists',
            'Catering',
            'Florists',
            'Venues',
            'DJs',
            'Decorators',
            'Car Rentals',
            'Bridal Wear',
        ];

        return [
            'type' => $this->faker->unique()->randomElement($categories),
            
            'description' => $this->faker->text(150),
            'image' => $this->faker->imageUrl(400, 300, 'business'),
        ];
    }
}