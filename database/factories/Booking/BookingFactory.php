<?php

namespace Database\Factories\Booking;

use App\Models\Booking\Booking;
use App\Models\Host\Host;
use App\Models\Business\Business;
use App\Models\Vendor\Vendor;
use App\Models\Business\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition()
    {
        return [
            'host_id' => Host::factory(),
            'business_id' => Business::factory(),
            'vendor_id' => Vendor::factory(),
            'package_id' => Package::factory(),
            'custom_booking_id' => $this->faker->unique()->uuid,
            'amount' => $this->faker->randomFloat(2, 100, 10000),
            'advance_percentage' => 10,
            'advance_amount' => null,
            'final_amount' => null,
            'advance_due_date' => $this->faker->optional()->date,
            'final_due_date' => $this->faker->optional()->date,
            'event_date' => $this->faker->date,
            'timezone' => 'UTC',
            'time_slot' => $this->faker->randomElement(['morning', 'afternoon', 'evening']),
            'guests' => $this->faker->numberBetween(10, 500),
            'advance_paid' => false,
            'final_paid' => false,
            'status' => 'pending',
            'approved_at' => null,
            'payment_completed_at' => null,
            'start_time' => null,
            'end_time' => null,
            'payment_status' => 'unpaid',
            'is_synced_with_calendar' => false,
            'extra_services' => null,
        ];
    }
}