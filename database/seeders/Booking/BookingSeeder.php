<?php

namespace Database\Seeders\Booking;

use App\Models\Booking\Booking;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        Booking::factory(10)->create();
        echo "✓ BookingSeeder completed - 10 bookings created\n";
    }
}