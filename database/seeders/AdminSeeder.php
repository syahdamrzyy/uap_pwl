<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin PERKEDEL',
            'email' => 'admin@perkedel.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
            'role' => 'admin',
        ]);
    }
}
