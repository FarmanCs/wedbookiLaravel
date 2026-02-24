<?php

namespace Database\Seeders\Utility;

use App\Models\Utility\PrivacyPolicy;
use Illuminate\Database\Seeder;

class PrivacyPolicySeeder extends Seeder
{
    public function run(): void
    {
        PrivacyPolicy::firstOrCreate(
            ['id' => 1],
            ['privacy_policy' => 'Your privacy policy content here...']
        );
    }
}