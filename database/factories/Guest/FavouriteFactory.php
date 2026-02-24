<?php

namespace Database\Factories\Guest;

use App\Models\Business\Business;
use App\Models\Guest\Favourite;
use App\Models\Host\Host;
use Illuminate\Database\Eloquent\Factories\Factory;

class FavouriteFactory extends Factory
{
    protected $model = Favourite::class;

    public function definition(): array
    {
        return [
            'host_id' => Host::factory(),
            'business_id' => Business::factory(),
        ];
    }
}