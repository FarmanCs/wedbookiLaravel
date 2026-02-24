<?php

namespace Database\Seeders\Content;

use App\Models\Content\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        Blog::factory()->count(30)->create();
    }
}