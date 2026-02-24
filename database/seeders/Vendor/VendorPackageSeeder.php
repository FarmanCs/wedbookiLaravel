<?php

namespace Database\Seeders\Vendor;

use App\Models\Vendor\Vendor;
use App\Models\Vendor\VendorPackage;
use Illuminate\Database\Seeder;

class VendorPackageSeeder extends Seeder
{
    public function run(): void
    {
        $vendors = Vendor::limit(10)->get();

        foreach ($vendors as $vendor) {
            VendorPackage::factory(1)->create([
                'vendor_id' => $vendor->id,
            ]);
        }

        echo "✓ VendorPackageSeeder completed - 10 packages created\n";
    }
}