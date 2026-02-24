<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition(): array
    {
        $roles = ['admin', 'moderator', 'support', 'manager'];
        
        return [
            'name' => $this->faker->randomElement($roles),
            'is_active' => true,
        ];
    }
}