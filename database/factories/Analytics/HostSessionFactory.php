<?php

namespace Database\Factories\Analytics;

use App\Models\Analytics\HostSession;
use Illuminate\Database\Eloquent\Factories\Factory;

class HostSessionFactory extends Factory
{
    protected $model = HostSession::class;

    public function definition(): array
    {
        $startedAt = $this->faker->dateTimeBetween('-7 days', 'now');
        return [
            'host_id' => \App\Models\Host\Host::inRandomOrder()->first()->id
                ?? \App\Models\Host\Host::factory(),
            'session_status' => $this->faker->randomElement(['Initiated', 'Started', 'Completed', 'Cancelled']),
            'params' => [
                'ip' => $this->faker->ipv4,
                'user_agent' => $this->faker->userAgent,
                'page' => $this->faker->randomElement(['/dashboard', '/search', '/profile']),
            ],
            'started_at' => $startedAt,
        ];
    }
}