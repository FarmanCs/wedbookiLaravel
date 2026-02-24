<?php

namespace Database\Seeders\Feature;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeaturePlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = \App\Models\Subscription\Plan::all();
        $features = \App\Models\Feature\Feature::all();
        foreach ($plans as $plan) {
            $randomFeatures = $features->random(rand(2, 5))->pluck('id')->toArray();
            foreach ($randomFeatures as $featureId) {
                DB::table('feature_plan')->insert([
                    'plan_id' => $plan->id,
                    'feature_id' => $featureId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}