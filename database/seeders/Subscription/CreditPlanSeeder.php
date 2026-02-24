<?php

namespace Database\Seeders\Subscription;

use App\Models\Subscription\CreditPlan;
use Illuminate\Database\Seeder;

class CreditPlanSeeder extends Seeder
{
    public function run(): void
    {
        CreditPlan::factory()->count(3)->create();
    }
}