<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisIbadah extends Model
{
    use HasFactory;

    protected $table = 'jenisIbadah'; // jika tabel berbeda dari default plural
    protected $primaryKey = 'ibadahID'; // atur primary key
    public $incrementing = false; // jika primary key bukan auto increment
    protected $keyType = 'string';
    public $timestamps = false; // Menonaktifkan timestamps

    const hari = [
        'senin' => 'Senin',
        'selasa' => 'Selasa',
        'rabu' => 'Rabu',
        'kamis' => 'Kamis',
        'jumat' => 'Jumat',
        'sabtu' => 'Sabtu',
        'minggu' => 'Minggu'
    ];

    protected $fillable = [
        'ibadahID',
        'namaIbadah',
        'hari',
        'waktu',
        'lokasi',
        'deskripsi'
    ];
    
    public function anggota()
    {
        return $this->belongsToMany(Anggota::class, 'anggota_jenisIbadah', 'ibadahID', 'anggotaID');
    }
    public function ibadah()
    {
        return $this->hasMany(Ibadah::class,'ibadahID', 'ibadahID');
    }
    public function kas()
    {
        return $this->hasMany(Kas::class, 'ibadahID', 'ibadahID');
    }
    public function pengeluaran()
    {
        return $this->hasMany(Pengeluaran::class, 'ibadahID', 'ibadahID');
    }
}

