<?php

namespace Database\Factories\Guest;

use App\Models\Guest\GuestGroup;
use App\Models\Host\Host;
use Illuminate\Database\Eloquent\Factories\Factory;

class GuestGroupFactory extends Factory
{
    protected $model = GuestGroup::class;

    public function definition(): array
    {
        return [
            'group_name' => $this->faker->word() . ' Group',
            'host_id' => Host::factory(),
        ];
    }
}