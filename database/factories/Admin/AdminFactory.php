<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'),
            'role' => 'admin',
            'otp' => null,
            'otp_attempts' => 0,
            'otp_expires_at' => null,
            'two_factor_code' => null,
            'two_factor_code_expires' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}