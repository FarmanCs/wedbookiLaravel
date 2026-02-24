<?php

namespace Database\Seeders\Content;

use App\Models\Content\AdminFaq;
use Illuminate\Database\Seeder;

class AdminFaqSeeder extends Seeder
{
    public function run(): void
    {
        AdminFaq::factory()->count(10)->create();
    }
}