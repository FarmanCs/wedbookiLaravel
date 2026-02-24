<?php

namespace Database\Seeders\Analytics;

use App\Models\Analytics\BusinessView;
use Illuminate\Database\Seeder;

class BusinessViewSeeder extends Seeder
{
    public function run(): void
    {
        $businesses = \App\Models\Business\Business::all();

        if ($businesses->isEmpty()) {
            $this->command->warn('⚠️ No businesses found. Skipping business views.');
            return;
        }

        foreach ($businesses as $business) {
            BusinessView::factory()->count(rand(5, 20))->create(['business_id' => $business->id]);
        }

        $this->command->info('✓ BusinessViewSeeder completed');
    }
}