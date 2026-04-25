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
            'name' => 'Admin Secure-Talent',
            'email' => 'admin@secure-talent.com',
            'password' => Hash::make('password'),
        ]);
    }
}
