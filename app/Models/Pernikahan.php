<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Anggota;
use App\Models\Pendeta;
use App\Models\AlamatPernikahan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pernikahan extends Model
{
    use HasFactory;

    protected $table = 'pernikahan';
    protected $primaryKey = 'pernikahanID'; // Menentukan primary key
    protected $keyType = 'string';

    public $timestamps = false; // Nonaktifkan timestamps jika tidak digunakan


    protected $fillable = [
        'pernikahanID',
        'anggotaID_suami',
        'anggotaID_istri',
        'pendetaID',
        'tanggalPernikahan',
        'namaOrangKua',
        'noStbld'
    ];

    public function getFormattedTanggalPernikahanAttribute()
    {
        // Set the locale to Indonesian
        Carbon::setLocale('id');
        
        // Format the date to 'day Month Year' in Indonesian
        return Carbon::parse($this->tanggalPernikahan)->locale('id')->translatedFormat('j F Y'); // Use translatedFormat
    }
    public function alamat()
    {
        return $this->hasOne(AlamatPernikahan::class, 'pernikahanID', 'pernikahanID');
    }




    public function suami()
{
    return $this->belongsTo(Anggota::class, 'anggotaID_suami', 'anggotaID');
}

public function istri()
{
    return $this->belongsTo(Anggota::class, 'anggotaID_istri', 'anggotaID');
}

public function pendeta()
{
    return $this->belongsTo(Pendeta::class, 'pendetaID', 'pendetaID');
}


}
