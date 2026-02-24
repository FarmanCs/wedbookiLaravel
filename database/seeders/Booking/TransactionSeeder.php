<?php

namespace Database\Seeders\Booking;

use App\Models\Booking\Booking;
use App\Models\Booking\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $bookings = Booking::limit(10)->get();

        foreach ($bookings as $booking) {
            Transaction::factory(1)->create([
                'booking_id' => $booking->id,
                'host_id' => $booking->host_id,
                'vendor_id' => $booking->vendor_id,
            ]);
        }

        echo "✓ TransactionSeeder completed - 10 transactions created\n";
    }
}