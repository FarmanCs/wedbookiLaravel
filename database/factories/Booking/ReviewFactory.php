<?php

namespace Database\Factories\Booking;

use App\Models\Booking\Review;
use App\Models\Business\Business;
use App\Models\Host\Host;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        return [
            'host_id' => Host::factory(),
            'business_id' => Business::factory(),
            'points' => $this->faker->numberBetween(1, 5),
            'text' => $this->faker->text(200),
        ];
    }
}