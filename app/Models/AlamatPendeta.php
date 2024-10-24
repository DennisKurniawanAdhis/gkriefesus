<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlamatPendeta extends Model
{
    use HasFactory;

    protected $table = 'alamat_pendeta';
    
    // Menonaktifkan timestamps (created_at, updated_at)
    public $timestamps = false;
    protected $primaryKey = 'alamatPendetaID'; 
    protected $fillable = [
        'pendetaID',
        'kelurahan',
        'kecamatan',
        'kota',
        'provinsi',
        'namaJalan',
        'RT',
        'RW',
        'kodePos'
    ];

    public function pendeta()
    {
        return $this->belongsTo(Pendeta::class, 'pendetaID', 'pendetaID');
    }
}
