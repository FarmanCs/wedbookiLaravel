<?php

namespace Database\Factories\Subscription;

use App\Models\Subscription\CreditsTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreditsTransactionFactory extends Factory
{
    protected $model = CreditsTransaction::class;

    public function definition(): array
    {
        return [
            'business_id' => \App\Models\Business\Business::inRandomOrder()->first()->id
                ?? \App\Models\Business\Business::factory(),
            'no_of_credits' => $this->faker->numberBetween(5, 200),
            'amount' => $this->faker->randomFloat(2, 10, 500),
            'from' => $this->faker->optional()->company,
            'to' => $this->faker->optional()->company,
            'tran_type' => $this->faker->randomElement(['credit', 'debit']),
        ];
    }
}