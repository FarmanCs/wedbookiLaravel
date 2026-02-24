<?php

namespace Database\Factories\Subscription;

use App\Models\Subscription\PlanTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanTransactionFactory extends Factory
{
    protected $model = PlanTransaction::class;

    public function definition(): array
    {
        return [
            'business_id' => \App\Models\Business\Business::inRandomOrder()->first()->id
                ?? \App\Models\Business\Business::factory(),
            'plan_id' => \App\Models\Subscription\Plan::inRandomOrder()->first()->id
                ?? \App\Models\Subscription\Plan::factory(),
            'tran_time' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'from' => $this->faker->optional()->word,
            'to' => $this->faker->optional()->word,
            'amount' => $this->faker->randomFloat(2, 20, 1000),
            'tran_type' => $this->faker->randomElement(['purchase', 'renewal']),
        ];
    }
}