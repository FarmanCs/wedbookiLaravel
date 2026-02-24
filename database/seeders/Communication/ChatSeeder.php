<?php

namespace Database\Seeders\Communication;

use App\Models\Communication\Chat;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    public function run(): void
    {
        // Create 30 chats using the factory
        Chat::factory()->count(30)->create();

        $this->command->info('✓ ChatSeeder completed - 30 chats created');
    }
}