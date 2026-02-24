<?php

namespace Database\Seeders\Booking;

use App\Models\Booking\ReviewReply;
use Illuminate\Database\Seeder;

class ReviewReplySeeder extends Seeder
{
    public function run(): void
    {
        ReviewReply::factory(10)->create();
        echo "✓ ReviewReplySeeder completed - 10 replies created\n";
    }
}