<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin default
        User::updateOrCreate(
            ['username' => 'superadmin'],
            [
                'nama_lengkap' => 'Super Administrator',
                'password'     => 'password123',
                'role'         => 'super_admin',
                'status'       => 'aktif',
            ]
        );

        // Admin default
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'nama_lengkap' => 'Administrator',
                'password'     => 'admin123',
                'role'         => 'admin',
                'status'       => 'aktif',
            ]
        );

        // User biasa (opsional)
        User::updateOrCreate(
            ['username' => 'user1'],
            [
                'nama_lengkap' => 'User Satu',
                'password'     => 'user123',
                'role'         => 'user',
                'status'       => 'aktif',
            ]
        );
    }
}
