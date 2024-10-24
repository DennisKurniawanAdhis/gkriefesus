<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaIbadah extends Model
{
    use HasFactory;
    protected $table = 'anggota_jenisIbadah';
    public $timestamps = false; // Menonaktifkan timestamps
    public function anggota()
    {
        return $this->belongsToMany(Anggota::class, 'anggota_jenisIbadah', 'ibadahID', 'anggotaID');
    }
}
