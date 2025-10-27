<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'superadmin@example.com'], // Search condition
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'role' => 'superadmin',
                'role_id' => 1,
            ]
        );

        User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('password'),
                'role' => 'user',
                'role_id' => 3,
            ]
        );

        User::firstOrCreate(
            ['email' => 'dev@example.com'],
            [
                'name' => 'Developer',
                'password' => Hash::make('password'),
                'role' => 'developer',
                'role_id' => 4,
            ]
        );
    }
}
