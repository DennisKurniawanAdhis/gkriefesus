<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ibadah extends Model
{
    use HasFactory;

    protected $table = 'ibadah';
    protected $primaryKey = 'dataIbadahID'; // Menentukan primary key
    public $incrementing = false; // Jika primary key bukan auto-increment
    protected $keyType = 'string';

    public $timestamps = false; // Nonaktifkan timestamps jika tidak digunakan


    protected $fillable = [
        'ibadahID',
        'pendetaID',
        'tanggalIbadah',
        'deskripsi'
    ];

    public function getFormattedTanggalIbadahAttribute()
    {
        // Set the locale to Indonesian
        Carbon::setLocale('id');
        
        // Format the date to 'day Month Year' in Indonesian
        return Carbon::parse($this->tanggalIbadah)->locale('id')->translatedFormat('j F Y'); // Use translatedFormat
    }

    public function pendeta()
    {
        return $this->belongsTo(Pendeta::class, 'pendetaID', 'pendetaID');
    }

    public function jenisIbadah()
    {
        return $this->belongsTo(JenisIbadah::class, 'ibadahID', 'ibadahID');
    }
    public function kas()
    {
        return $this->hasOne(Kas::class, 'dataIbadahID', 'dataIbadahID');
    }
}
