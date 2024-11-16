<?php

namespace App\Http\Controllers;

use App\Models\Ibadah;
use App\Models\Pendeta;
use App\Models\Pernikahan;
use App\Models\CalonBaptis;
use App\Models\JenisIbadah;
use Illuminate\Http\Request;
use App\Models\AlamatPendeta;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class PendetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function alamat()
    {
        return $this->hasOne(AlamatPendeta::class);
    }


    // public function ibadah()
    // {
    //     return $this->belongsToMany(JenisIbadah::class);
    // }
    public function index(Request $request)
    {

        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' ) {
            return redirect()->back();
        }
        // Cek apakah ada input pencarian dari user
        $search = $request->input('search');
    
        // Query untuk mencari anggota berdasarkan nama depan atau belakang
        $pendeta = Pendeta::with('alamat')->where('namaDepanPendeta', 'LIKE', "%{$search}%")
                    ->orWhere('namaBelakangPendeta', 'LIKE', "%{$search}%")
                    ->simplePaginate(5);
                    
        $pendeta->appends(['search' => $search]);
    
        return view('pendeta.index', compact('pendeta'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' ) {
            return redirect()->back();
        }
        
        $jenisKelamin = Pendeta::jenisKelamin;
        $statusKawin = Pendeta::statusKawin;
        // $jenisIbadah = JenisIbadah::all();
        // $keahlian = Keahlian::all();

        return view('pendeta.create', compact('jenisKelamin', 'statusKawin'));
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    if (!Auth::check() || Auth::user()->role !== 'keanggotaan' ) {
        return redirect()->back();
    }
    $lastPendeta = \App\Models\Pendeta::orderBy('pendetaID', 'desc')->first();

    // Jika ada pendetaID terakhir, ekstrak bagian numerik dan tambahkan 1
    if ($lastPendeta) {
        // Misal: PDT001 -> Ambil 001, tambahkan 1
        $lastNumber = intval(substr($lastPendeta->pendetaID, 3));
        $newNumber = $lastNumber + 1;

        // Format dengan tiga digit angka dan awalan 'PDT'
        $pendetaID = 'PDT' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    } else {
        // Jika belum ada pendetaID, mulai dari PDT001
        $pendetaID = 'PDT001';
    }

    // Buat anggota baru dan simpan
$pendeta = new Pendeta();
$pendeta->pendetaID = $pendetaID;  // Pastikan anggotaID sesuai dengan input yang benar
$pendeta->noTelp = $request->noTelp;
$pendeta->namaDepanPendeta = $request->namaDepanPendeta;
$pendeta->namaBelakangPendeta = $request->namaBelakangPendeta;
$pendeta->tanggalLahir = $request->tanggalLahir;
$pendeta->tempatLahir = $request->tempatLahir;
$pendeta->jenisKelamin = $request->jenisKelamin;
$pendeta->statusKawin = $request->statusKawin;
$pendeta->noKK = $request->noKK;
$pendeta->NIK = $request->NIK;
$pendeta->pekerjaan = $request->pekerjaan;
$pendeta->gelar = $request->gelar;
$pendeta->save();  // Simpan data anggota

// Buat alamat baru dan simpan
$alamat = new AlamatPendeta();
$alamat->pendetaID = $pendetaID; // Pastikan foreign key sesuai
$alamat->kelurahan = $request->kelurahan;
$alamat->kecamatan = $request->kecamatan;
$alamat->kota = $request->kota;
$alamat->provinsi = $request->provinsi;
$alamat->namaJalan = $request->namaJalan;
$alamat->RT = $request->RT;
$alamat->RW = $request->RW;
$alamat->kodePos = $request->kodePos;
$alamat->save();  // Simpan data alamat


return redirect()->route('pendeta')->with('success', 'Pendeta added successfully');

}

  
    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     $pendeta = Pendeta::findOrFail($id);
    //     $alamat = $pendeta->alamat;

    //     // $jenisIbadah = JenisIbadah::withCount(['ibadah' => function ($query) use ($pendeta) {
    //     //     $query->where('pendetaID', $pendeta->pendetaID);
    //     // }])->get();

    //     // $jumlahPernikahan = Pernikahan::where('pendetaID', $pendeta->pendetaID)->count();
    //     // $jumlahBaptis = CalonBaptis::where('pendetaID', $pendeta->pendetaID)->count();
      
    //     return view('pendeta.show', compact('pendeta','alamat'));
    // }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' ) {
            return redirect()->back();
        }
        $pendeta = Pendeta::where('pendetaID', $id)->firstOrFail();
        $jenisKelamin = Pendeta::jenisKelamin;
        $statusKawin = Pendeta::statusKawin;
        $alamatPendeta = $pendeta->alamat; 
        
        return view('pendeta.edit', compact('pendeta','jenisKelamin', 'statusKawin', 'alamatPendeta'));
        
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' ) {
            return redirect()->back();
        }
        $pendeta = Pendeta::findOrFail($id);
        
        $pendeta->update($request->all());

        if ($pendeta->alamat) {
            $pendeta->alamat->update($request->only([
                'namaJalan', 'RT', 'RW', 'kodePos', 'kelurahan', 'kecamatan', 'kota', 'provinsi'
            ]));
        }

  
        return redirect()->route('pendeta')->with('success', 'Pendeta updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' ) {
            return redirect()->back();
        }
        $pendeta = Pendeta::findOrFail($id);
        
        $relatedRecords = Pernikahan::where('pendetaID', $id)->count();
        $relatedRecordBaptis = CalonBaptis::where('pendetaID', $id)->count();
    
        if ($relatedRecords > 0 || $relatedRecordBaptis > 0) {
            return redirect()->route('pendeta')->with('warning', 'Tidak dapat menghapus pendeta ini karena masih ada data yang menggunakannya.');
        }

        $pendeta->delete();
  
        return redirect()->route('pendeta')->with('success', 'Pendeta deleted successfully');
    }

  


    
}
