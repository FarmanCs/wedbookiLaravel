<?php

namespace Database\Seeders\Communication;

use App\Models\Communication\Notification;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        Notification::factory()->count(50)->create();
        $this->command->info('✓ NotificationSeeder completed - 50 notifications created');
    }
}