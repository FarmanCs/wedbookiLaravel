<?php

namespace Database\Seeders\Admin;

use App\Models\Admin\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create a default super admin
        Admin::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'first_name' => 'Super',
                'password' => Hash::make('password'),
                'role' => 'super-admin',
            ]
        );

        // Create a few random admins using factory
        Admin::factory()->count(5)->create();
    }
}