<?php

namespace Database\Factories\Auth;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'country' => $this->faker->country,
            'email' => $this->faker->unique()->safeEmail,
            'phone_no' => $this->faker->numerify('##########'),
            'password' => Hash::make('password'),
            'otp' => null,
            'otp_attempts' => 0,
            'otp_expires_at' => null,
            'is_verified' => false,
            'remember_token' => null,
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
            'last_login' => null,
        ];
    }
}