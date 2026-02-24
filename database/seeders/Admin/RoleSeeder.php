<?php

namespace Database\Seeders\Admin;

use App\Models\Admin\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'super-admin'],
            ['name' => 'admin'],
            ['name' => 'vendor'],
            ['name' => 'host'],
            ['name' => 'user'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role['name']]);
        }
    }
}