<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel users.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin Perpus',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'), // ✅ bcrypt hash
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
