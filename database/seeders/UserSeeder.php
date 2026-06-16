<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ─── ADMIN ───
        User::create([
            'nama'     => 'Risa',
            'email'    => 'admin@jemaribidan.com',
            'password' => Hash::make('admin123'),
            'no_hp'    => '082231627718',
            'alamat'   => 'Surabaya, Jawa Timur',
            'role'     => 'admin',
        ]);

        // ─── USER BIASA (Contoh) ───
        User::create([
            'nama'     => 'Fitri',
            'email'    => 'fitri@example.com',
            'password' => Hash::make('user123'),
            'no_hp'    => '081234567890',
            'alamat'   => 'Sidoarjo, Jawa Timur',
            'role'     => 'user',
        ]);

        // ─── USER BIASA KEDUA (Opsional) ───
        User::create([
            'nama'     => 'Shinta',
            'email'    => 'shinta@example.com',
            'password' => Hash::make('user123'),
            'no_hp'    => '089876543210',
            'alamat'   => 'Gresik, Jawa Timur',
            'role'     => 'user',
        ]);
    }
}