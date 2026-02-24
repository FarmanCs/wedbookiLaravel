<?php

namespace Database\Factories\Host;

use App\Models\Host\Host;
use App\Models\Host\HostSession;
use Illuminate\Database\Eloquent\Factories\Factory;

class HostSessionFactory extends Factory
{
    protected $model = HostSession::class;

    public function definition(): array
    {
        return [
            'host_id' => Host::factory(),
            'session_status' => $this->faker->randomElement(['Initiated', 'Started', 'Completed', 'Cancelled']),
            'params' => json_encode([
                'ip_address' => $this->faker->ipv4(),
                'user_agent' => $this->faker->userAgent(),
            ]),
            'started_at' => now(),
        ];
    }
}