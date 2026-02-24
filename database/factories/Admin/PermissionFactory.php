<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Permission;
use App\Models\Admin\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    protected $model = Permission::class;

    public function definition(): array
    {
        $permissions = [
            'create_user' => 'Create User',
            'edit_user' => 'Edit User',
            'delete_user' => 'Delete User',
            'view_reports' => 'View Reports',
            'manage_content' => 'Manage Content',
            'manage_admins' => 'Manage Admins',
        ];

        $key = array_key_first($permissions);
        $name = array_shift($permissions);

        return [
            'role_id' => Role::factory(),
            'name' => $name,
            'key' => $key,
            'is_active' => true,
        ];
    }
}