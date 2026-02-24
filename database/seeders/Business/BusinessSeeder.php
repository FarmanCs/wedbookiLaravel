<?php

namespace Database\Seeders\Business;

use App\Models\Business\Business;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    public function run(): void
    {
        Business::factory(10)->create();
        echo "✓ BusinessSeeder completed - 10 businesses created\n";
    }
}