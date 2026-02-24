<?php

namespace Database\Factories\Communication;

use App\Models\Communication\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition(): array
    {
        // Get a random chat or create one
        $chat = \App\Models\Communication\Chat::inRandomOrder()->first()
            ?? \App\Models\Communication\Chat::factory()->create();

        // Randomly pick a participant from the chat as sender
        $participants = $chat->participants;
        $sender = $this->faker->randomElement($participants);

        return [
            'chat_id' => $chat->id,
            'sender' => $sender,
            'text' => $this->faker->optional(0.7)->sentence,
            'chat_image_url' => $this->faker->optional(0.1)->imageUrl(),
            'chat_video_url' => $this->faker->optional(0.05)->url(),
            'chat_document_url' => $this->faker->optional(0.05)->url(),
            'seen_by' => [],
        ];
    }
}