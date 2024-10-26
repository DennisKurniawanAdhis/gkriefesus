<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\GenerateAnggotaID;


class Anggota extends Model
{
    use HasFactory;

    
    protected $table = 'anggota';
    protected $primaryKey = 'anggotaID'; // Menentukan primary key
    protected $keyType = 'string';

    public $timestamps = false; // Nonaktifkan timestamps jika tidak digunakan
    const jenisKelamin = [
        'pria' => 'Pria',
        'wanita' => 'Wanita',
    ];

    const statusKawin = [
        'Belum Menikah' => 'Belum Menikah',
        'Sudah Menikah' => 'Sudah Menikah',
        'Duda' => 'Duda',
        'Janda' => 'Janda',
    ];
    protected $fillable = [
        'anggotaID',
        'noTelp',
        'namaDepanAnggota',
        'namaBelakangAnggota',
        'tanggalLahir',
        'tempatLahir',
        'jenisKelamin',
        'statusKawin',
        'noKK',
        'NIK',
        'pekerjaan',
        'jabatan'
    ];
    public function getFormattedTanggalLahirAttribute()
    {
        // Set the locale to Indonesian
        Carbon::setLocale('id');
        
        // Format the date to 'day Month Year' in Indonesian
        return Carbon::parse($this->tanggalLahir)->locale('id')->translatedFormat('j F Y'); // Use translatedFormat
    }
    public function alamat()
    {
        return $this->hasOne(AlamatAnggota::class, 'anggotaID', 'anggotaID'); // Menyesuaikan foreign key
    }

    public function pernikahanSebagaiSuami()
{
    return $this->hasOne(Pernikahan::class, 'anggotaID_suami', 'anggotaID');
}

public function pernikahanSebagaiIstri()
{
    return $this->hasOne(Pernikahan::class, 'anggotaID_istri', 'anggotaID');
}


    public function jenisIbadah()
{
    return $this->belongsToMany(JenisIbadah::class, 'anggota_jenisIbadah', 'anggotaID', 'ibadahID');
}

public function keahlian()
{
    return $this->belongsToMany(Keahlian::class, 'anggota_keahlian', 'anggotaID', 'keahlianID');
}

public function komisi()
{
    return $this->belongsTo(Komisi::class,  'komisiID', 'komisiID');
}

public function calonBaptis()
{
    return $this->hasOne(CalonBaptis::class ,'anggotaID','anggotaID');
}


public function kas()
{
    return $this->hasMany(Kas::class, 'anggotaID', 'anggotaID');
}

}
