<?php

namespace Database\Seeders\Analytics;

use App\Models\Analytics\BusinessSocialClick;
use Illuminate\Database\Seeder;

class BusinessSocialClickSeeder extends Seeder
{
    public function run(): void
    {
        $businesses = \App\Models\Business\Business::all();

        if ($businesses->isEmpty()) {
            $this->command->warn('⚠️ No businesses found. Skipping social clicks.');
            return;
        }

        foreach ($businesses as $business) {
            BusinessSocialClick::factory()->count(rand(0, 10))->create(['business_id' => $business->id]);
        }

        $this->command->info('✓ BusinessSocialClickSeeder completed');
    }
}