<?php

namespace Database\Seeders\Subscription;

use App\Models\Subscription\PlanTransaction;
use Illuminate\Database\Seeder;

class PlanTransactionSeeder extends Seeder
{
    public function run(): void
    {
        $businesses = \App\Models\Business\Business::all();
        $plans = \App\Models\Subscription\Plan::all();
        foreach ($businesses as $business) {
            if (rand(0, 1)) {
                PlanTransaction::factory()->count(1)->create([
                    'business_id' => $business->id,
                    'plan_id' => $plans->random()->id,
                ]);
            }
        }
    }
}