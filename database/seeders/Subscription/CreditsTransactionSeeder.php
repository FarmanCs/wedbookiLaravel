<?php

namespace Database\Seeders\Subscription;

use App\Models\Subscription\CreditsTransaction;
use Illuminate\Database\Seeder;

class CreditsTransactionSeeder extends Seeder
{
    public function run(): void
    {
        $businesses = \App\Models\Business\Business::all();
        foreach ($businesses as $business) {
            if (rand(0, 1)) {
                CreditsTransaction::factory()->count(1)->create(['business_id' => $business->id]);
            }
        }
    }
}