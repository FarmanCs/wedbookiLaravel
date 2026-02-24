<?php

namespace Database\Factories\Booking;

use App\Models\Booking\Booking;
use App\Models\Booking\Invoice;
use App\Models\Business\Business;
use App\Models\Host\Host;
use App\Models\Vendor\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    public function definition(): array
    {
        $totalAmount = $this->faker->numberBetween(1000, 10000);
        $advanceAmount = $totalAmount * 0.10;

        return [
            'booking_id' => Booking::factory(),
            'host_id' => Host::factory(),
            'business_id' => Business::factory(),
            'vendor_id' => Vendor::factory(),
            'sender_name' => $this->faker->name(),
            'receiver_name' => $this->faker->name(),
            'invoice_number' => 'INV-' . Str::random(10),
            'payment_type' => $this->faker->randomElement(['advance', 'final', 'full']),
            'total_amount' => $totalAmount,
            'advance_amount' => $advanceAmount,
            'remaining_amount' => $totalAmount - $advanceAmount,
            'base_amount_paid' => 0,
            'platform_fee_from_user' => $totalAmount * 0.05,
            'total_user_paid' => 0,
            'vendor_share' => $totalAmount * 0.85,
            'platform_share' => $totalAmount * 0.15,
            'commission_rate' => 15,
            'vendor_plan_name' => 'Premium',
            'advance_due_date' => now()->addDays(7),
            'final_due_date' => now()->addDays(30),
            'advance_percentage' => 10,
            'is_advance_paid' => false,
            'is_final_paid' => false,
        ];
    }
}