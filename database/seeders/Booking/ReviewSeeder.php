<?php

namespace Database\Seeders\Booking;

use App\Models\Booking\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        Review::factory(10)->create();
        echo "✓ ReviewSeeder completed - 10 reviews created\n";
    }
}