<?php

namespace Database\Factories\Communication;

use App\Models\Communication\Chat;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChatFactory extends Factory
{
    protected $model = Chat::class;

    public function definition(): array
    {
        // Get random host and vendor IDs (or create them if none exist)
        $host = \App\Models\Host\Host::inRandomOrder()->first();
        $vendor = \App\Models\Vendor\Vendor::inRandomOrder()->first();

        // If either is missing, create one
        if (!$host) {
            $host = \App\Models\Host\Host::factory()->create();
        }
        if (!$vendor) {
            $vendor = \App\Models\Vendor\Vendor::factory()->create();
        }

        // Build participants array with required structure
        $participants = [
            [
                'user_id' => $host->id,
                'user_model' => 'App\\Models\\Host\\Host',
                'name' => $host->full_name ?? $host->name,
                'email' => $host->email,
                'avatar' => $host->profile_image,
            ],
            [
                'user_id' => $vendor->id,
                'user_model' => 'App\\Models\\Vendor\\Vendor',
                'name' => $vendor->full_name ?? $vendor->name,
                'email' => $vendor->email,
                'avatar' => $vendor->profile_image,
            ],
        ];

        return [
            'participants' => $participants,
            'last_message_id' => null, // will be updated later
        ];
    }
}