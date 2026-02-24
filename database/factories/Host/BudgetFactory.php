<?php

namespace Database\Factories\Host;

use App\Models\Host\Budget;
use App\Models\Host\Host;
use Illuminate\Database\Eloquent\Factories\Factory;

class BudgetFactory extends Factory
{
    protected $model = Budget::class;

    public function definition(): array
    {
        $total = $this->faker->numberBetween(10000, 100000);

        return [
            'host_id' => Host::factory(),
            'total_budget' => $total,
            'breakdown' => json_encode([
                'venue' => $total * 0.30,
                'catering' => $total * 0.25,
                'decoration' => $total * 0.15,
                'photography' => $total * 0.15,
                'music_dj' => $total * 0.10,
                'other' => $total * 0.05,
            ]),
        ];
    }
}