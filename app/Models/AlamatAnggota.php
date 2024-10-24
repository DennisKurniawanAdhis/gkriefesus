<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlamatAnggota extends Model
{
    use HasFactory;

    protected $table = 'alamat_anggota';
    
    // Menonaktifkan timestamps (created_at, updated_at)
    public $timestamps = false;
    protected $primaryKey = 'alamatAnggotaID'; 
    protected $fillable = [
        'anggotaID',
        'kelurahan',
        'kecamatan',
        'kota',
        'provinsi',
        'namaJalan',
        'RT',
        'RW',
        'kodePos'
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggotaID', 'anggotaID');
    }
}
