<?php

namespace Database\Seeders\Utility;

use App\Models\Utility\Counter;
use Illuminate\Database\Seeder;

class CounterSeeder extends Seeder
{
    public function run(): void
    {
        $counters = [
            ['name' => 'booking', 'seq' => 1000],
            ['name' => 'invoice', 'seq' => 5000],
        ];
        foreach ($counters as $counter) {
            Counter::firstOrCreate(['name' => $counter['name']], $counter);
        }
    }
}