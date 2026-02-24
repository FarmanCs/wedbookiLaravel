<?php

namespace Database\Seeders\Analytics;

use App\Models\Analytics\HostSession;
use Illuminate\Database\Seeder;

class HostSessionSeeder extends Seeder
{
    public function run(): void
    {
        $hosts = \App\Models\Host\Host::all();

        if ($hosts->isEmpty()) {
            $this->command->warn('⚠️ No hosts found. Skipping host sessions.');
            return;
        }

        foreach ($hosts as $host) {
            HostSession::factory()->count(rand(3, 10))->create(['host_id' => $host->id]);
        }

        $this->command->info('✓ HostSessionSeeder completed');
    }
}