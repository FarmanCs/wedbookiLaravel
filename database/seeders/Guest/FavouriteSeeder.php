<?php

namespace Database\Seeders\Guest;

use App\Models\Guest\Favourite;
use Illuminate\Database\Seeder;

class FavouriteSeeder extends Seeder
{
    public function run(): void
    {
        Favourite::factory(10)->create();
        echo "✓ FavouriteSeeder completed - 10 favorites created\n";
    }
}