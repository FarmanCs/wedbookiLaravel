<?php

namespace Database\Seeders\Host;

use App\Models\Host\HostSession;
use App\Models\Host\Host;
use Illuminate\Database\Seeder;

class HostSessionSeeder extends Seeder
{
    public function run(): void
    {
        $hosts = Host::limit(10)->get();

        foreach ($hosts as $host) {
            HostSession::factory(1)->create([
                'host_id' => $host->id,
            ]);
        }

        echo "✓ HostSessionSeeder completed - 10 sessions created\n";
    }
}