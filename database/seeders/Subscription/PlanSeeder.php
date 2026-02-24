<?php

namespace Database\Seeders\Subscription;

use App\Models\Subscription\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        Plan::factory()->count(5)->create();
    }
}