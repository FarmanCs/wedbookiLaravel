<?php

namespace Database\Factories\Content;

use App\Models\Content\AdminFaq;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFaqFactory extends Factory
{
    protected $model = AdminFaq::class;

    public function definition(): array
    {
        return [
            'question' => $this->faker->sentence,
            'answer'   => $this->faker->paragraph,
            'status'   => $this->faker->randomElement(['draft', 'published']),
        ];
    }
}