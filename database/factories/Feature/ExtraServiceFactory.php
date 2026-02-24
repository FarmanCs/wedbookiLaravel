<?php

namespace Database\Factories\Feature;

use App\Models\Feature\ExtraService;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExtraServiceFactory extends Factory
{
    protected $model = ExtraService::class;

    public function definition(): array
    {
        return [
            'business_id' => \App\Models\Business\Business::inRandomOrder()->first()->id 
                ?? \App\Models\Business\Business::factory(),
            'service_id' => null, // optional: link to service if needed
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 10, 500),
        ];
    }
}