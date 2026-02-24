<?php

namespace Database\Factories\Content;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Content\Faq>
 */
class FaqFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'cms_setting_id' => \App\Models\Content\CmsSettings::factory(), // or existing ID
        'question' => $this->faker->sentence,
        'answer' => $this->faker->paragraph,
        'is_published' => $this->faker->boolean,
        'last_updated' => now(),
        ];
    }
}
