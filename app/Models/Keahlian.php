<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Keahlian extends Model
{
    use HasFactory;
    
    protected $table = 'keahlian'; // jika tabel berbeda dari default plural
    protected $primaryKey = 'keahlianID'; // atur primary key
    protected $keyType = 'string';
    public $timestamps = false; // Menonaktifkan timestamps
    protected $fillable = [
        'keahlianID',
        'namaKeahlian',
        'deskripsi'
    ];
    public function anggota()
    {
        return $this->belongsToMany(Anggota::class, 'anggota_keahlian', 'keahlianID', 'anggotaID');
    }
}