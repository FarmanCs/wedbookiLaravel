<?php

namespace Database\Factories\Communication;

use App\Models\Communication\SupportQuery;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupportQueryFactory extends Factory
{
    protected $model = SupportQuery::class;

    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
            'subject' => $this->faker->sentence,
            'priority' => $this->faker->randomElement(['low', 'medium', 'high', 'urgent']),
            'message' => $this->faker->paragraph,
            'attachments' => $this->faker->optional(0.2)->randomElements([$this->faker->url, $this->faker->url]),
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'resolved', 'closed']),
        ];
    }
}