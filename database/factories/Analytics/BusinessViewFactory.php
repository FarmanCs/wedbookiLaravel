<?php

namespace Database\Factories\Analytics;

use App\Models\Analytics\BusinessView;
use Illuminate\Database\Eloquent\Factories\Factory;

class BusinessViewFactory extends Factory
{
    protected $model = BusinessView::class;

    public function definition(): array
    {
        return [
            'business_id' => \App\Models\Business\Business::inRandomOrder()->first()->id
                ?? \App\Models\Business\Business::factory(),
            'device_id' => $this->faker->uuid,
            'viewed_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
        ];
    }
}