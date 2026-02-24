<?php

namespace Database\Seeders\Feature;

use App\Models\Feature\ExtraService;
use Illuminate\Database\Seeder;

class ExtraServiceSeeder extends Seeder
{
    public function run(): void
    {
        $businesses = \App\Models\Business\Business::all();
        foreach ($businesses as $business) {
            ExtraService::factory()->count(rand(0, 5))->create(['business_id' => $business->id]);
        }
    }
}