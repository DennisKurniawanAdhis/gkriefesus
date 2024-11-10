<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class KeahlianSeeder extends Seeder
{
    public function run()
    {
        DB::table('keahlian')->insert([
            'keahlianID' => 'K001',
            'namaKeahlian' => 'Bernyanyi',
            'deskripsi' => 'Bernyanyi untuk  menjadil WL atau singer',
        ]);
    }
}