<?php

namespace Database\Factories\Booking;

use App\Models\Booking\Booking;
use App\Models\Booking\Transaction;
use App\Models\Host\Host;
use App\Models\Vendor\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition(): array
    {
        return [
            'booking_id' => Booking::factory(),
            'host_id' => Host::factory(),
            'vendor_id' => Vendor::factory(),
            'amount' => $this->faker->numberBetween(1000, 10000),
            'status' => $this->faker->randomElement(['initiated', 'successful', 'failed', 'refunded']),
            'payment_method' => $this->faker->randomElement(['credit_card', 'debit_card', 'paypal', 'stripe']),
            'payment_reference' => 'TXN-' . Str::random(15),
            'sender_name' => $this->faker->name(),
            'receiver_name' => $this->faker->name(),
            'tran_type' => 'payment',
            'cart_currency' => 'USD',
            'paid_at' => now(),
        ];
    }
}