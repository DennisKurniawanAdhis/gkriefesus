<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kas extends Model
{
    use HasFactory;

    protected $table = 'kas'; // jika tabel berbeda dari default plural
    protected $primaryKey = 'kasID'; // atur primary key
    public $incrementing = false; // jika primary key bukan auto increment
    protected $keyType = 'string';
    public $timestamps = false; // Menonaktifkan timestamps

    protected $fillable = [
        'anggotaID',
        'ibadahID',
        'tanggal',
        'deskripsi',
        'jenisUang',
        'jumlaUang',
        'namaPenyumbang',
        'dataIbadahID'
    ];

    public function getFormattedTanggalAttribute()
    {
        // Set the locale to Indonesian
        Carbon::setLocale('id');
        
        // Format the date to 'day Month Year' in Indonesian
        return Carbon::parse($this->tanggal)->locale('id')->translatedFormat('j F Y'); // Use translatedFormat
    }

    public function anggota()
{
    return $this->belongsTo(Anggota::class,  'anggotaID', 'anggotaID');
}
public function jenisIbadah()
{
    return $this->belongsTo(JenisIbadah::class, 'ibadahID', 'ibadahID'); // Asumsikan ibadahID adalah foreign key
}

public function ibadah()
    {
        return $this->belongsTo(Ibadah::class, 'dataIbadahID', 'dataIbadahID');
    }
}
