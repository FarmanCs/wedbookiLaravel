<?php

namespace Database\Factories\Auth;

use App\Models\Auth\PersonalAccessToken;
use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PersonalAccessTokenFactory extends Factory
{
    protected $model = PersonalAccessToken::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->word(),
            'token' => hash('sha256', Str::random(40)),
            'abilities' => json_encode(['read', 'write']),
            'expires_at' => now()->addYear(),
        ];
    }
}