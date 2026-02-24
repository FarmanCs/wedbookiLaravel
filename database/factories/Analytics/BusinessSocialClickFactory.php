<?php

namespace Database\Factories\Analytics;

use App\Models\Analytics\BusinessSocialClick;
use Illuminate\Database\Eloquent\Factories\Factory;

class BusinessSocialClickFactory extends Factory
{
    protected $model = BusinessSocialClick::class;

    public function definition(): array
    {
        return [
            'business_id' => \App\Models\Business\Business::inRandomOrder()->first()->id
                ?? \App\Models\Business\Business::factory(),
            'platform' => $this->faker->randomElement(['facebook', 'twitter', 'instagram', 'linkedin', 'pinterest']),
            'device_id' => $this->faker->uuid,
            'clicked_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
        ];
    }
}