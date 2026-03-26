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
        // ADMIN
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'is_approved' => true,
            'phone' => '081234567890',
        ]);

        // PENGELOLA APPROVED
        User::create([
            'name' => 'Pengelola Approved',
            'email' => 'pengelola@example.com',
            'password' => Hash::make('pengelola123'),
            'role' => 'pengelola',
            'is_approved' => true,
            'phone' => '081234567891',
        ]);

        // PENGELOLA BELUM APPROVED
        User::create([
            'name' => 'Pengelola Pending',
            'email' => 'pengelola_pending@example.com',
            'password' => Hash::make('pengelola_pending123'),
            'role' => 'pengelola',
            'is_approved' => false,
            'phone' => '081234567892',
        ]);

        // DONATUR
        User::create([
            'name' => 'Donatur',
            'email' => 'donatur@example.com',
            'password' => Hash::make('donatur123'),
            'role' => 'donatur',
        ]);

        User::create([
            'name' => 'Donatur2',
            'email' => 'donatur2@example.com',
            'password' => Hash::make('donatur2123'),
            'role' => 'donatur',
        ]);

        User::create([
            'name' => 'Donatur3',
            'email' => 'donatur3@example.com',
            'password' => Hash::make('donatur3123'),
            'role' => 'donatur',
        ]);
    }
}
