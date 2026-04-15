<?php

namespace Database\Seeders\Subscription;

use App\Models\Subscription\Credits;
use Illuminate\Database\Seeder;

class CreditSeeder extends Seeder
{
    public function run(): void
    {
        Credits::factory()->count(3)->create();
    }
}
