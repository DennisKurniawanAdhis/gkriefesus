<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlamatCalonBaptis extends Model
{
    use HasFactory;

    protected $table = 'alamat_calon_baptis';
    
    // Menonaktifkan timestamps (created_at, updated_at)
    public $timestamps = false;
    protected $primaryKey = 'alamatBaptisID'; 
    protected $fillable = [
        'baptisID',
        'kelurahan',
        'kecamatan',
        'kota',
        'provinsi',
        'namaJalan',
        'RT',
        'RW',
        'kodePos'
    ];

    public function baptis()
    {
        return $this->belongsTo(CalonBaptis::class, 'baptisID', 'baptisID');
    }
}
