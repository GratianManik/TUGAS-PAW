<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Password di-hash otomatis oleh cast 'hashed' di model User
        User::updateOrCreate(
            ['email' => 'admin@rental.test'],
            ['name' => 'Admin Bengkel', 'password' => 'password123', 'role' => 'admin']
        );

        User::updateOrCreate(
            ['email' => 'staff@rental.test'],
            ['name' => 'Staff Rental', 'password' => 'password123', 'role' => 'staff']
        );
    }
}
