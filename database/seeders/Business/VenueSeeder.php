<?php

namespace Database\Seeders\Business;

use App\Models\Business\Venue;
use App\Models\Vendor\Vendor;
use Illuminate\Database\Seeder;

class VenueSeeder extends Seeder
{
    public function run(): void
    {
        $vendors = Vendor::limit(10)->get();

        foreach ($vendors as $vendor) {
            Venue::factory(1)->create([
                'vendor_id' => $vendor->id,
            ]);
        }

        echo "✓ VenueSeeder completed - 10 venues created\n";
    }
}