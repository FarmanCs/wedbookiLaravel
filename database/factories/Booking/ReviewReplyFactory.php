<?php

namespace Database\Factories\Booking;

use App\Models\Booking\Review;
use App\Models\Booking\ReviewReply;
use App\Models\Business\Business;
use App\Models\Vendor\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewReplyFactory extends Factory
{
    protected $model = ReviewReply::class;

    public function definition(): array
    {
        return [
            'review_id' => Review::factory(),
            'business_id' => Business::factory(),
            'vendor_id' => Vendor::factory(),
            'text' => $this->faker->text(150),
        ];
    }
}