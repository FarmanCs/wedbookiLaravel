<?php

namespace Database\Factories\Communication;

use App\Models\Communication\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    public function definition(): array
    {
        $scheduledAt = $this->faker->optional(0.3)->dateTimeBetween('now', '+1 month');
        return [
            'title' => $this->faker->sentence,
            'message' => $this->faker->paragraph,
            'type' => $this->faker->randomElement(['Announcement', 'Alert', 'Reminder']),
            'recipients' => $this->faker->randomElement(['Users', 'Vendors', 'All']),
            'delivery_method' => $this->faker->randomElement(['Email', 'SMS', 'Push Notification', 'All']),
            'send_mode' => $scheduledAt ? 'Schedule' : $this->faker->randomElement(['Send Immediately', 'Save as draft']),
            'scheduled_at' => $scheduledAt,
            'status' => $this->faker->randomElement(['draft', 'published']),
        ];
    }
}