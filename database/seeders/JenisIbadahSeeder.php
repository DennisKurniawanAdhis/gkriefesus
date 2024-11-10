<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class JenisIbadahSeeder extends Seeder
{
    public function run()
    {
        DB::table('jenisIbadah')->insert([
            'ibadahID' => 'B001',
            'namaIbadah' => 'Umum',
            'hari' => 'minggu',
            'waktu' => '09:30:00',
            'lokasi' => 'Gereja Utama',
            'deskripsi' => 'Ibadah rutin setiap minggu di gereja utama.',
        ]);
    }
}