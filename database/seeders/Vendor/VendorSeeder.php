<?php

namespace Database\Seeders\Vendor;

use App\Models\Category\Category;
use App\Models\Vendor\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class VendorSeeder extends Seeder
{
    public function run(): void
    {
        // Get or create category
        $category = Category::firstOrCreate(
            ['type' => 'Photography'],
            ['description' => 'Professional Photography Services']
        );

        // Create test vendor
        Vendor::create([
            'full_name' => 'Professional Vendor',
            'email' => 'vendor@example.com',
            'phone_no' => '1234567890',
            'country_code' => '+1',
            'profile_image' => 'https://via.placeholder.com/200',
            'years_of_experience' => 10,
            'languages' => json_encode(['English', 'Spanish']),
            'team_members' => 5,
            'specialties' => json_encode(['Photography', 'Videography']),
            'about' => 'Professional event vendor with 10 years of experience.',
            'country' => 'United States',
            'city' => 'New York',
            'role' => 'vendor',
            'password' => Hash::make('password'),
            'category_id' => $category->id,
            'postal_code' => '10001',
            'otp_attempts' => 0,
            'profile_verification' => 'approved',
            'email_verified' => true,
            'payout_currency' => 'usd',
            'signup_method' => 'email',
            'cover_image' => 'https://via.placeholder.com/800x400',
            'last_login' => now(),
            'is_active' => true,
        ]);

        // Create 9 more vendors
        Vendor::factory(9)->create();

        echo "✓ VendorSeeder completed - 10 vendors created\n";
        echo "  Test Login: vendor@eventify.com / password\n";
    }
}