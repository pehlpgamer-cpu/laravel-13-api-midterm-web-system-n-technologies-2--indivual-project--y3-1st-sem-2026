<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::factory()->create([
            'role_id' => 1,
            'role' => 'customer'
        ]);

        Role::factory()->create([
            'role_id' => 2,
            'role' => 'admin'
        ]);

        Role::factory()->create([
            'role_id' => 3,
            'role' => 'employee'
        ]);
    }
}
