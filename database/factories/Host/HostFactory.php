<?php

namespace Database\Factories\Host;

use App\Models\Host\Host;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class HostFactory extends Factory
{
    protected $model = Host::class;

    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name(),
            'partner_full_name' => $this->faker->name(),
            'partner_email' => $this->faker->unique()->safeEmail(),
            'country' => $this->faker->country(),
            'email' => $this->faker->unique()->safeEmail(),
            'country_code' => '+1',
            'phone_no' => $this->faker->numberBetween(1000000000, 9999999999), // 10-digit integer
            'profile_image' => $this->faker->imageUrl(200, 200, 'people'),
            'about' => $this->faker->text(200),
            'wedding_date' => $this->faker->dateTimeBetween('+1 month', '+12 months'),
            'password' => Hash::make('password'),
            'status' => 'approved',
            'role' => 'host',
            'is_verified' => 'verified',
            'signup_method' => 'email',
            'category' => $this->faker->word(),
            'event_type' => $this->faker->randomElement(['wedding', 'birthday', 'corporate']),
            'estimated_guests' => $this->faker->numberBetween(50, 500),
            'event_budget' => $this->faker->numberBetween(5000, 50000),
            'otp_attempts' => 0,
            'join_date' => now(),
            'account_deactivated' => false,
            'account_soft_deleted' => false,
        ];
    }
}