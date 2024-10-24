<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaKeahlian extends Model
{
    use HasFactory;
    protected $table = 'anggota_keahlian';
    public $timestamps = false; // Menonaktifkan timestamps
    public function anggota()
    {
        return $this->belongsToMany(Anggota::class, 'anggota_keahlian', 'keahlianID', 'anggotaID');
    }
}
