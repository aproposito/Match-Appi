<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    User::firstOrCreate(
        ['email' => 'admin@matchappi.com'],
        ['name' => 'Admin', 'password' => 'password', 'role' => 'admin']
    );

    User::firstOrCreate(
        ['email' => 'user@matchappi.com'],
        ['name' => 'Usuario Demo', 'password' => 'password', 'role' => 'user']
    );

    User::factory()->count(6)->create(); // rol 'user' por defecto
}
}
