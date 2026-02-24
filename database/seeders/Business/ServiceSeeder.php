<?php

namespace Database\Seeders\Business;

use App\Models\Business\Service;
use App\Models\Vendor\Vendor;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $vendors = Vendor::limit(10)->get();

        foreach ($vendors as $vendor) {
            Service::factory(1)->create([
                'vendor_id' => $vendor->id,
            ]);
        }

        echo "✓ ServiceSeeder completed - 10 services created\n";
    }
}