<?php

namespace Database\Seeders\Vendor;

use App\Models\Business\Business;
use App\Models\Vendor\VendorTiming;
use Illuminate\Database\Seeder;

class VendorTimingSeeder extends Seeder
{
    public function run(): void
    {
        $businesses = Business::limit(10)->get();

        foreach ($businesses as $business) {
            VendorTiming::factory()->create([
                'business_id' => $business->id,
            ]);
        }

        echo "✓ VendorTimingSeeder completed - " . $businesses->count() . " timings created\n";
    }
}