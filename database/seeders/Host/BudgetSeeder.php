<?php

namespace Database\Seeders\Host;

use App\Models\Host\Budget;
use App\Models\Host\Host;
use Illuminate\Database\Seeder;

class BudgetSeeder extends Seeder
{
    public function run(): void
    {
        $hosts = Host::limit(10)->get();

        foreach ($hosts as $host) {
            Budget::factory(1)->create([
                'host_id' => $host->id,
            ]);
        }

        echo "✓ BudgetSeeder completed - 10 budgets created\n";
    }
}