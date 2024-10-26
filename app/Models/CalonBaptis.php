<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CalonBaptis extends Model
{
    use HasFactory;

    protected $table = 'calonBaptis';
    protected $primaryKey = 'baptisID'; // Menentukan primary key
    protected $keyType = 'string';

    public $timestamps = false; // Nonaktifkan timestamps jika tidak digunakan


    protected $fillable = [
        'baptisID',
        'anggotaID',
        'pendetaID',
        'namaIbu',
        'namaAyah',
        'tanggalBaptis'
    ];

    public function getFormattedTanggalBaptisAttribute()
    {
        // Set the locale to Indonesian
        Carbon::setLocale('id');
        
        // Format the date to 'day Month Year' in Indonesian
        return Carbon::parse($this->tanggalBaptis)->locale('id')->translatedFormat('j F Y'); // Use translatedFormat
    }

    public function pendeta()
    {
        return $this->belongsTo(Pendeta::class, 'pendetaID', 'pendetaID');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggotaID', 'anggotaID');
    }

    public function alamat()
    {
        return $this->hasOne(AlamatCalonBaptis::class, 'baptisID', 'baptisID'); // Menyesuaikan foreign key
    }

    
}
