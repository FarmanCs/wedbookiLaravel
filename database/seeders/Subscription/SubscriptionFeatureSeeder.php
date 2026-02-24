<?php

namespace Database\Seeders\Subscription;

use App\Models\Subscription\Subscription;
use App\Models\Subscription\SubscriptionFeature;
use Illuminate\Database\Seeder;

class SubscriptionFeatureSeeder extends Seeder
{
    public function run(): void
    {
        $subscriptions = Subscription::all();
        foreach ($subscriptions as $sub) {
            SubscriptionFeature::factory()->count(rand(1, 5))->create(['subscription_id' => $sub->id]);
        }
    }
}