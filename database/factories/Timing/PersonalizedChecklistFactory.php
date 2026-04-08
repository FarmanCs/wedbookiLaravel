<?php

namespace Database\Factories\Timing;

use App\Models\Timing\PersonalizedChecklist;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonalizedChecklistFactory extends Factory
{
    protected $model = PersonalizedChecklist::class;

    public function definition(): array
    {
        return [
            'check_list_title' => $this->faker->sentence(),

            'check_list_category' => $this->faker->randomElement([
                'venue',
                'vendor',
                'guests',
                'planning',
                'budget'
            ]),

            'check_list_description' => $this->faker->paragraph(),

            'check_list_due_date' => $this->faker->dateTimeBetween('now', '+6 months'),

            'checklist_status' => $this->faker->randomElement([
                'pending',
                'completed'
            ]),

            'is_custom' => $this->faker->boolean(),
        ];
    }
}
