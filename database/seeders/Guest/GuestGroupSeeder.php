<?php

namespace Database\Seeders\Guest;

use App\Models\Guest\GuestGroup;
use App\Models\Guest\Guest;
use App\Models\Host\Host;
use Illuminate\Database\Seeder;

class GuestGroupSeeder extends Seeder
{
    public function run(): void
    {
        $hosts = Host::limit(5)->get();

        foreach ($hosts as $host) {
            $group = GuestGroup::factory(1)->create([
                'host_id' => $host->id,
            ])->first();

            // Attach some guests to the group
            $guests = Guest::limit(3)->get();
            $group->guests()->attach($guests->pluck('id')->toArray());
        }

        echo "✓ GuestGroupSeeder completed - 5 guest groups created\n";
    }
}