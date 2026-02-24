<?php

namespace Database\Seeders\Feature;

use App\Models\Feature\AdminPackage;
use Illuminate\Database\Seeder;

class AdminPackageSeeder extends Seeder
{
    public function run(): void
    {
        AdminPackage::factory()->count(5)->create();
    }
}