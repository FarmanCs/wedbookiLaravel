<?php

namespace Database\Seeders\Host;

use App\Models\Host\Host;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class HostSeeder extends Seeder
{
    public function run(): void
    {
        // Create test host
        Host::create([
            'full_name' => 'John Host',
            'partner_full_name' => 'Jane Host',
            'partner_email' => 'jane@eventify.com',
            'country' => 'United States',
            'email' => 'host@example.com',
            'country_code' => '+1',
            'phone_no' => 1234567890,
            'profile_image' => 'https://via.placeholder.com/200',
            'about' => 'We are planning the perfect event.',
            'wedding_date' => now()->addMonths(6),
            'password' => Hash::make('password'),
            'status' => 'approved',
            'role' => 'host',
            'is_verified' => 'verified',
            'signup_method' => 'email',
            'category' => 'Wedding',
            'event_type' => 'wedding',
            'estimated_guests' => 200,
            'event_budget' => 25000,
            'otp_attempts' => 0,
            'join_date' => now(),
            'account_deactivated' => false,
            'account_soft_deleted' => false,
        ]);

        // Create 9 more hosts
        Host::factory(9)->create();

        echo "✓ HostSeeder completed - 10 hosts created\n";
        echo "  Test Login: host@eventify.com / password\n";
    }
}