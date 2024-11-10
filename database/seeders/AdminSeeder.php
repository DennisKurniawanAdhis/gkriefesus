<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'Dennis',
            'password' => Hash::make('@Dennis123'), // Menggunakan Hash::make untuk meng-hash password
            'role' => 'super',
        ]);
    }
}