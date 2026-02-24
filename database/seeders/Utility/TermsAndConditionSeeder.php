<?php

namespace Database\Seeders\Utility;

use App\Models\Utility\TermsAndCondition;
use Illuminate\Database\Seeder;

class TermsAndConditionSeeder extends Seeder
{
    public function run(): void
    {
        TermsAndCondition::firstOrCreate(
            ['id' => 1],
            ['terms_and_conditions' => 'Your terms and conditions content here...']
        );
    }
}