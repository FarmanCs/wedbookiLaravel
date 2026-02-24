<?php

namespace Database\Seeders\Communication;

use App\Models\Communication\SupportQuery;
use Illuminate\Database\Seeder;

class SupportQuerySeeder extends Seeder
{
    public function run(): void
    {
        SupportQuery::factory()->count(20)->create();
        $this->command->info('✓ SupportQuerySeeder completed - 20 support queries created');
    }
}