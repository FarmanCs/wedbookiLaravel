<?php

namespace Database\Seeders\Timing;

use App\Models\Business\Business;
use App\Models\Timing\Timing;
use Illuminate\Database\Seeder;

class TimingSeeder extends Seeder
{
    public function run(): void
    {
        $businesses = Business::all();
        foreach ($businesses as $business) {
            Timing::factory()->count(1)->create(['business_id' => $business->id]);
        }
    }
}