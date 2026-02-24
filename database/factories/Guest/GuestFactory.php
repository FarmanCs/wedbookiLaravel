<?php

namespace Database\Factories\Guest;

use App\Models\Guest\Guest;
use Illuminate\Database\Eloquent\Factories\Factory;

class GuestFactory extends Factory
{
    protected $model = Guest::class;

    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'full_name' => $this->faker->name(),
            'phone_no' => $this->faker->phoneNumber(),
            'mobile_no' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'state' => $this->faker->state(),
            'city' => $this->faker->city(),
            'zipcode' => $this->faker->postcode(),
            'is_joining' => $this->faker->randomElement(['Pending', 'Accepted', 'Rejected']),
        ];
    }
}