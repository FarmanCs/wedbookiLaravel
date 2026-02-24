<?php

namespace Database\Seeders\Utility;

use App\Models\Utility\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            ['name' => 'United States', 'code' => 'US'],
            ['name' => 'United Kingdom', 'code' => 'GB'],
            ['name' => 'Canada', 'code' => 'CA'],
            ['name' => 'Australia', 'code' => 'AU'],
        ];
        // Store as JSON in the 'countries' column
        Country::firstOrCreate(
            ['id' => 1],
            ['countries' => $countries]
        );
    }
}