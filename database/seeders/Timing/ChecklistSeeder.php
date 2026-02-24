<?php

namespace Database\Seeders\Timing;

use App\Models\Host\Host;
use App\Models\Timing\Checklist;
use Illuminate\Database\Seeder;

class ChecklistSeeder extends Seeder
{
    public function run(): void
    {
        $hosts =Host::all();
        foreach ($hosts as $host) {
            Checklist::factory()->count(1)->create(['host_id' => $host->id]);
        }
    }
}