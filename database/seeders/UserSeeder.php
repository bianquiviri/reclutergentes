<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Bianquiviri Admin',
            'email' => 'bianquiviri@gmail.com',
            'password' => Hash::make('!N1k00905'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Recluter',
            'email' => 'recluter@example.com',
            'password' => Hash::make('password'),
            'role' => 'recluter',
        ]);
    }
}
