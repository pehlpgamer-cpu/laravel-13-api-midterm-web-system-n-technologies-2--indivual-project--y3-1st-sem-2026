<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = 'Password-123456790';
        $adminRole = Role::query()->where('role', UserRole::Admin)->value('role_id');
        $customerRole = Role::query()->where('role', UserRole::Customer)->value('role_id');

        User::create([
            'name' => 'Chad the admin',
            'email' => 'admin001@gmail.com',
            'password' => $password,
            'role_id' => $adminRole,
        ]);

        User::create([
            'name' => 'MrAdmin 101',
            'email' => 'admin002@gmail.com',
            'password' => $password,
            'role_id' => $adminRole,
        ]);

        User::create([
            'name' => 'Chud',
            'email' => 'customer001@gmail.com',
            'password' => $password,
            'role_id' => $customerRole,
        ]);

        User::create([
            'name' => 'Star man',
            'email' => 'customer002@gmail.com',
            'password' => $password,
            'role_id' => $customerRole,
        ]);
    }
}
