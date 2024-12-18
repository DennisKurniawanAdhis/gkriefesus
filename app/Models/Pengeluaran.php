<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran'; // jika tabel berbeda dari default plural
    protected $primaryKey = 'pengeluaranID'; // atur primary key
    protected $keyType = 'string';
    public $timestamps = false; // Menonaktifkan timestamps

    protected $fillable = [
        'ibadahID',
        'tanggal',
        'deskripsi',
        'jenisPengeluaran',
        'jumlahUang' // Pastikan nama kolom benar
    ];
    // Di dalam model Pengeluaran
protected $casts = [
    'tanggal' => 'date',
];


    public function getFormattedTanggalAttribute()
    {
        // Set the locale to Indonesian
        Carbon::setLocale('id');
        
        // Format the date to 'day Month Year' in Indonesian
        return Carbon::parse($this->tanggal)->locale('id')->translatedFormat('j F Y'); // Use translatedFormat
    }

    public function jenisIbadah()
    {
        return $this->belongsTo(JenisIbadah::class, 'ibadahID', 'ibadahID');
    }
    public function ibadah()
    {
        return $this->belongsTo(Ibadah::class, 'dataIbadahID', 'dataIbadahID');
    }
}
