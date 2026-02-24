<?php

namespace Database\Factories\Vendor;

use App\Models\Vendor\Vendor;
use App\Models\Vendor\VendorPackage;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendorPackageFactory extends Factory
{
    protected $model = VendorPackage::class;

    public function definition(): array
    {
        $vendorTypes = [
            'Photographers',
            'Videographers',
            'Makeup Artists',
            'Catering',
            'Florists',
        ];

        $packageLevels = ['Silver', 'Gold', 'Platinum'];

        return [
            'vendor_id' => Vendor::factory(),
            'vendor_type' => $this->faker->randomElement($vendorTypes),
            'package_level' => $this->faker->randomElement($packageLevels),
            'package_description' => $this->faker->text(100),
            'prices' => json_encode([
                'half_day' => $this->faker->numberBetween(100, 500),
                'full_day' => $this->faker->numberBetween(500, 2000),
            ]),
            'package_features' => json_encode([
                'Feature 1',
                'Feature 2',
                'Feature 3',
            ]),
        ];
    }
}