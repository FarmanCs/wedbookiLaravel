<?php

namespace Database\Seeders\Category;

use App\Models\Category\Category;
use App\Models\Category\SubCategory;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::limit(5)->get();

        foreach ($categories as $category) {
            SubCategory::factory(2)->create([
                'category_id' => $category->id,
            ]);
        }

        echo "✓ SubCategorySeeder completed - 10 subcategories created\n";
    }
}