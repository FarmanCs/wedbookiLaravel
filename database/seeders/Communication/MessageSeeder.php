<?php

namespace Database\Seeders\Communication;

use App\Models\Communication\Chat;
use App\Models\Communication\Message;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        $chats = Chat::all();

        if ($chats->isEmpty()) {
            $this->command->warn('⚠️ No chats found. Skipping message creation.');
            return;
        }

        foreach ($chats as $chat) {
            Message::factory()->count(rand(5, 20))->create(['chat_id' => $chat->id]);
        }

        $this->command->info('✓ MessageSeeder completed');
    }
}