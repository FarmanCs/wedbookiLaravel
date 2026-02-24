<?php

namespace Database\Factories\Vendor;
use App\Models\Vendor\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class VendorFactory extends Factory
{
    protected $model = Vendor::class;

    public function definition()
    {
        return [
            'full_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone_no' => $this->faker->numerify('##########'),
            'pending_email' => null,
            'country_code' => $this->faker->randomElement(['+1', '+44']),
            'profile_image' => null,
            'years_of_experience' => $this->faker->optional()->numberBetween(1, 20),
            'languages' => $this->faker->optional()->randomElements(['English', 'Spanish', 'French'], 2),
            'team_members' => $this->faker->optional()->numberBetween(1, 50),
            'specialties' => $this->faker->optional()->randomElements(['Wedding', 'Birthday', 'Corporate'], 3),
            'about' => $this->faker->optional()->paragraph,
            'country' => $this->faker->country,
            'city' => $this->faker->city,
            'role' => 'vendor',
            'password' => Hash::make('password'),
            'category_id' => null,
            'postal_code' => $this->faker->postcode,
            'otp' => null,
            'otp_attempts' => 0,
            'otp_expires_at' => null,
            'otp_attempt_count' => null,
            'two_factor_code' => null,
            'two_factor_code_expires' => null,
            'remember_token' => null,
            'profile_verification' => 'approved',
            'email_verified' => false,
            'stripe_account_id' => null,
            'bank_last4' => null,
            'bank_name' => null,
            'account_holder_name' => null,
            'payout_currency' => 'usd',
            'custom_vendor_id' => null,
            'google_id' => null,
            'signup_method' => 'email',
            'cover_image' => null,
            'last_login' => null,
            'account_deactivated' => false,
            'is_active' => false,
            'account_soft_deleted' => false,
            'account_soft_deleted_at' => null,
            'auto_hard_delete_after_days' => 30,
        ];
    }
}