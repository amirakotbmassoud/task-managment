<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Manager user
        User::updateOrCreate(
            ['email' => 'manager@example.com'],
            [
                'name' => 'Main Manager',
                'password' => Hash::make('password123'),
                'role' => 'manager',
            ]
        );

        // Normal users
        User::updateOrCreate(
            ['email' => 'user1@example.com'],
            [
                'name' => 'User One',
                'password' => Hash::make('password123'),
                'role' => 'user',
            ]
        );

        User::updateOrCreate(
            ['email' => 'user2@example.com'],
            [
                'name' => 'User Two',
                'password' => Hash::make('password123'),
                'role' => 'user',
            ]
        );
       //
    }
}
