<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\AlamatPendeta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendeta extends Model
{
    use HasFactory;

    protected $table = 'pendeta';
    protected $primaryKey = 'pendetaID'; // Menentukan primary key
    public $incrementing = false; // Jika primary key bukan auto-increment
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
        'pendetaID',
        'noTelp',
        'namaDepanPendeta',
        'namaBelakangPendeta',
        'tanggalLahir',
        'tempatLahir',
        'jenisKelamin',
        'statusKawin',
        'noKK',
        'NIK',
        'pekerjaan',
        'gelar'
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
        return $this->hasOne(AlamatPendeta::class, 'pendetaID', 'pendetaID'); // Menyesuaikan foreign key
    }

    public function pernikahan()
{
    return $this->hasMany(Pernikahan::class, 'pendetaID', 'pendetaID');
}

public function baptis()
{
    return $this->hasMany(CalonBaptis::class, 'pendetaID', 'pendetaID');
}

public function ibadah()
{
    return $this->hasMany(Ibadah::class,'ibadahID', 'ibadahID');
}

}
