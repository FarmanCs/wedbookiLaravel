<?php

namespace Database\Seeders\Subscription;

use App\Models\Business\Business;
use App\Models\Subscription\Plan;
use App\Models\Subscription\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    public function run(): void
    {
        $businesses = Business::all();
        $plans = Plan::all();
        foreach ($businesses as $business) {
            if (rand(0, 1)) {
                Subscription::factory()->count(1)->create([
                    'business_id' => $business->id,
                    'plan_id' => $plans->random()->id,
                ]);
            }
        }
    }
}