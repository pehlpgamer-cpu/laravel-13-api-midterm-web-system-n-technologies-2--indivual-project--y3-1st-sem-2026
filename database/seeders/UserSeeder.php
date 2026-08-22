<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Chad the admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin_password',
        ]);

        User::factory()->create([
            'name' => 'MrAdmin 101',
            'email' => 'admin101@gmail.com',
            'password' => 'admin_password',
        ]);
    }
}
