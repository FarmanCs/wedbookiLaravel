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
            'business_id' => \App\Models\Business\Business::inRandomOrder()->value('id')
                ?? \App\Models\Business\Business::factory(),

            'no_of_credits' => $this->faker->numberBetween(5, 200),
            'amount' => $this->faker->randomFloat(2, 10, 500),

            'from_source' => $this->faker->optional()->company,
            'to_source'   => $this->faker->optional()->company,

            'tran_type' => $this->faker->randomElement(['purchase', 'refund', 'adjustment']),
            'status' => $this->faker->randomElement(['pending', 'completed', 'failed', 'refunded']),

            'ad_credits' => $this->faker->numberBetween(0, 50),
        ];
    }
}
