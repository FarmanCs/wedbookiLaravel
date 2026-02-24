<?php

namespace Database\Seeders\Auth;

use App\Models\Auth\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create test user
        User::create([
            'first_name' => 'Regular',
            'last_name' => 'User',
            'country' => 'United States',
            'email' => 'user@eventify.com',
            'phone_no' => 1234567890,
            'password' => Hash::make('password'),
            'is_verified' => true,
            'otp_attempts' => 0,
            'last_login' => now(),
        ]);

        // Create 9 more users
        User::factory(9)->create();

        echo "✓ UserSeeder completed - 10 users created\n";
        echo "  Test Login: user@eventify.com / password\n";
    }
}