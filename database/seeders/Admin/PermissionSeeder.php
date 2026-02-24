<?php

namespace Database\Seeders\Admin;

use App\Models\Admin\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['name' => 'View Dashboard', 'key' => 'view-dashboard'],
            ['name' => 'Manage Users', 'key' => 'manage-users'],
            ['name' => 'Manage Vendors', 'key' => 'manage-vendors'],
            ['name' => 'Manage Hosts', 'key' => 'manage-hosts'],
            ['name' => 'Manage Bookings', 'key' => 'manage-bookings'],
            ['name' => 'Manage Content', 'key' => 'manage-content'],
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(
                ['key' => $perm['key']],
                $perm
            );
        }
    }
}