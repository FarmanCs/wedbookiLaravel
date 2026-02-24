<?php

namespace Database\Seeders\Timing;

use App\Models\Timing\PersonalizedChecklist;
use Illuminate\Database\Seeder;

class PersonalizedChecklistSeeder extends Seeder
{
    public function run(): void
    {
        $hosts = \App\Models\Host\Host::all();
        foreach ($hosts as $host) {
            PersonalizedChecklist::factory()->count(rand(5, 15))->create(['host_id' => $host->id]);
        }
    }
}