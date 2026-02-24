<?php

namespace Database\Seeders\Category;

use App\Models\Category\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['type' => 'Photographers', 'description' => 'Professional photography services'],
            ['type' => 'Videographers', 'description' => 'Professional video production'],
            ['type' => 'Makeup Artists', 'description' => 'Professional makeup services'],
            ['type' => 'Catering', 'description' => 'Food and beverage services'],
            ['type' => 'Florists', 'description' => 'Floral arrangements and decoration'],
            ['type' => 'Venues', 'description' => 'Event venues and banquet halls'],
            ['type' => 'DJs', 'description' => 'Professional DJ and music services'],
            ['type' => 'Decorators', 'description' => 'Event decoration and design'],
            ['type' => 'Car Rentals', 'description' => 'Premium car rental services'],
            ['type' => 'Bridal Wear', 'description' => 'Wedding dresses and bridal wear'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['type' => $category['type']],
                $category
            );
        }

        echo "✓ CategorySeeder completed - 10 categories created\n";
    }
}