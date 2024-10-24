<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlamatPernikahan extends Model
{
    use HasFactory;

    protected $table = 'alamat_pernikahan';
    
    // Menonaktifkan timestamps (created_at, updated_at)
    public $timestamps = false;
    protected $primaryKey = 'alamatPernikahanID'; 
    protected $fillable = [
        'pernikahanID',
        'kelurahan',
        'kecamatan',
        'kota',
        'provinsi',
        'namaJalan',
        'RT',
        'RW',
        'kodePos'
    ];

    public function pernikahan()
    {
        return $this->belongsTo(Pernikahan::class, 'pernikahanID', 'pernikahanID');
    }


   
}
