<?php

namespace Database\Seeders\Feature;

use App\Models\Feature\Feature;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    public function run(): void
    {
        // Create 10 random features
        Feature::factory()->count(10)->create();
    }
}