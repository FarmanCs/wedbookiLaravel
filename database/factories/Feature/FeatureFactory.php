<?php

namespace Database\Factories\Feature;

use App\Models\Feature\Feature;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeatureFactory extends Factory
{
    protected $model = Feature::class;

    public function definition(): array
    {
        $name = $this->faker->words(2, true);
        return [
            'name' => $name,
            'key' => str($name)->slug('_'),
            'description' => $this->faker->optional()->sentence,
            'value' => $this->faker->optional()->word,
            'is_active' => $this->faker->boolean(90),
        ];
    }
}