<?php

namespace Database\Factories\Subscription;

use App\Models\Subscription\SubscriptionFeature;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFeatureFactory extends Factory
{
    protected $model = SubscriptionFeature::class;

    public function definition(): array
    {
        return [
            'subscription_id' => \App\Models\Subscription\Subscription::inRandomOrder()->first()->id
                ?? \App\Models\Subscription\Subscription::factory(),
            'name' => $this->faker->words(2, true),
            'features' => [
                $this->faker->word,
                $this->faker->word,
                $this->faker->word,
            ],
            'is_active' => $this->faker->boolean(90),
            'is_deleted' => false,
        ];
    }
}