<?php

namespace Database\Factories\Subscription;

use App\Models\Subscription\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    protected $model = Subscription::class;

    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-6 months', 'now');
        $endDate = (clone $startDate)->modify('+1 year');

        return [
            'name' => $this->faker->randomElement(['Basic', 'Standard', 'Premium']),
            'business_id' => \App\Models\Business\Business::inRandomOrder()->first()->id
                ?? \App\Models\Business\Business::factory(),
            'plan_id' => \App\Models\Subscription\Plan::inRandomOrder()->first()->id
                ?? \App\Models\Subscription\Plan::factory(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'subscription_type' => $this->faker->randomElement(['monthly', 'quarterly', 'yearly']),
            'credits' => $this->faker->numberBetween(0, 500),
            'last_credit_date' => $this->faker->dateTimeBetween('-1 month', 'now'), // Always a value
            'last_reminder_sent' => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
            'last_renewal_attempt' => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
            'amount' => $this->faker->randomFloat(2, 50, 1000),
            'status' => $this->faker->randomElement(['active', 'expired', 'cancelled']),
        ];
    }
}