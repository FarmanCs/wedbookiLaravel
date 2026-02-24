<?php

namespace Database\Factories\Vendor;

use App\Models\Business\Business;
use App\Models\Vendor\VendorTiming;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendorTimingFactory extends Factory
{
    protected $model = VendorTiming::class;

    public function definition(): array
    {
        return [
            'business_id' => Business::inRandomOrder()->first()->id
                ?? Business::factory(),
            'timings_venue' => [
                'morning' => '09:00-12:00',
                'afternoon' => '12:00-18:00',
                'evening' => '18:00-23:00',
            ],
            'slot_duration' => $this->faker->randomElement([30, 60, 90, 120]),
            'working_hours' => [
                'monday' => ['09:00', '18:00'],
                'tuesday' => ['09:00', '18:00'],
                'wednesday' => ['09:00', '18:00'],
                'thursday' => ['09:00', '18:00'],
                'friday' => ['09:00', '18:00'],
                'saturday' => ['10:00', '20:00'],
                'sunday' => 'closed',
            ],
            'timings_service_weekly' => [
                'monday' => ['09:00', '12:00', '15:00'],
                'tuesday' => ['09:00', '12:00', '15:00'],
            ],
            'unavailable_dates' => [
                $this->faker->date('Y-m-d', '+1 month'),
                $this->faker->date('Y-m-d', '+2 months'),
            ],
        ];
    }
}