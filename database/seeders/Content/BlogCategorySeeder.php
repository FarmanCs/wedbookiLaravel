<?php

namespace Database\Seeders\Content;

use App\Models\Content\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Wedding Tips', 'Vendor Spotlight', 'Real Weddings', 'Trends'];
        foreach ($categories as $cat) {
            BlogCategory::firstOrCreate(['category_name' => $cat]);
        }
    }
}