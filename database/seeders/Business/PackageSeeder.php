<?php

namespace Database\Seeders\Business;

use App\Models\Business\Business;
use App\Models\Business\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $businesses = Business::limit(10)->get();

        foreach ($businesses as $business) {
            Package::factory(1)->create([
                'business_id' => $business->id,
            ]);
        }

        echo "✓ PackageSeeder completed - 10 packages created\n";
    }
}