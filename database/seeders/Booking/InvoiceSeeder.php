<?php

namespace Database\Seeders\Booking;

use App\Models\Booking\Booking;
use App\Models\Booking\Invoice;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    public function run(): void
    {
        $bookings = Booking::limit(10)->get();

        foreach ($bookings as $booking) {
            Invoice::factory(1)->create([
                'booking_id' => $booking->id,
                'host_id' => $booking->host_id,
                'business_id' => $booking->business_id,
                'vendor_id' => $booking->vendor_id,
            ]);
        }

        echo "✓ InvoiceSeeder completed - 10 invoices created\n";
    }
}