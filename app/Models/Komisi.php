<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komisi extends Model
{
    use HasFactory;
    protected $table = 'komisi';
    protected $primaryKey = 'komisiID'; // Menentukan primary key
    protected $keyType = 'string';

    public $timestamps = false; // Nonaktifkan timestamps jika tidak digunakan
    protected $fillable = [
        'namaKomisi',
        'deskripsi'
    ];

    public function anggota()
    {
        return $this->hasMany(Anggota::class,'komisiID', 'komisiID');
    }

}
