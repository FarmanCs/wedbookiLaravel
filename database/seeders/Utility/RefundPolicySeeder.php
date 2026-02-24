<?php

namespace Database\Seeders\Utility;

use App\Models\Utility\RefundPolicy;
use Illuminate\Database\Seeder;

class RefundPolicySeeder extends Seeder
{
    public function run(): void
    {
        RefundPolicy::firstOrCreate(
            ['id' => 1],
            ['refund_policy' => 'Your refund policy content here...']
        );
    }
}