<?php

namespace Database\Seeders\Guest;

use App\Models\Guest\Guest;
use Illuminate\Database\Seeder;

class GuestSeeder extends Seeder
{
    public function run(): void
    {
        Guest::factory(100)->create();
        echo "✓ GuestSeeder completed - 10 guests created\n";
    }
}