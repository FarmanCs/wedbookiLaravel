<?php

namespace Database\Factories\Subscription;

use App\Models\Subscription\PlanTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PlanTransactionFactory extends Factory
{
    protected $model = PlanTransaction::class;

    public function definition(): array
    {
        // subscription start
        $start = Carbon::instance(
            $this->faker->dateTimeBetween('-1 year', 'now')
        );

        // random billing cycle
        $cycle = $this->faker->randomElement([
            'monthly',
            'quarterly',
            'annually'
        ]);

        // calculate end date
        $end = match ($cycle) {
            'monthly' => $start->copy()->addMonth(),
            'quarterly' => $start->copy()->addMonths(3),
            'annually' => $start->copy()->addYear(),
        };

        return [
            'business_id' =>
            \App\Models\Business\Business::inRandomOrder()->value('id')
                ?? \App\Models\Business\Business::factory(),

            'plan_id' =>
            \App\Models\Subscription\Plan::inRandomOrder()->value('id')
                ?? \App\Models\Subscription\Plan::factory(),

            'transaction_time' => $start,

            'start_at' => $start,
            'end_at' => $end,

            'amount' => $this->faker->randomFloat(2, 200, 5000),

            'transaction_type' =>
            $this->faker->randomElement(['purchase', 'renewal']),
        ];
    }
}
