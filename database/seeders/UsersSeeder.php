<?php

namespace Database\Seeders;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // insert into user
        User::create([
            'name'  => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => '12345678'
        ]);
    }
}
