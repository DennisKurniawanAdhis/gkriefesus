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
        // Cek apakah ada input pencarian dari user
        $search = $request->input('search');
    
        // Query untuk mencari anggota berdasarkan nama depan atau belakang
        $pendeta = Pendeta::where('namaDepanPendeta', 'LIKE', "%{$search}%")
                    ->orWhere('namaBelakangPendeta', 'LIKE', "%{$search}%")
                    ->get();
    
        return view('pendeta.index', compact('pendeta'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        
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
    // Buat anggota baru dan simpan
$pendeta = new Pendeta();
$pendeta->pendetaID = $request->pendetaID;  // Pastikan anggotaID sesuai dengan input yang benar
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
$alamat->pendetaID = $pendeta->pendetaID; // Pastikan foreign key sesuai
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
    public function show(string $id)
    {
        $pendeta = Pendeta::findOrFail($id);
        $alamat = $pendeta->alamat;

        $jenisIbadah = JenisIbadah::withCount(['ibadah' => function ($query) use ($pendeta) {
            $query->where('pendetaID', $pendeta->pendetaID);
        }])->get();

        $jumlahPernikahan = Pernikahan::where('pendetaID', $pendeta->pendetaID)->count();
        $jumlahBaptis = CalonBaptis::where('pendetaID', $pendeta->pendetaID)->count();
      
        return view('pendeta.show', compact('pendeta','alamat','jenisIbadah','jumlahBaptis','jumlahPernikahan'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
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
        $pendeta = Pendeta::findOrFail($id);
  
        $pendeta->delete();
  
        return redirect()->route('pendeta')->with('success', 'Pendeta deleted successfully');
    }

  
//     public function dashboard(Request $request, string $pendetaID)
// {
//     // Ambil data pendeta berdasarkan ID
//     $pendeta = Pendeta::findOrFail($pendetaID);
    
//     // Ambil daftar pelayanan terkait pendeta, asumsikan ada relasi
//     $ibadah = Ibadah::where('pendetaID', $pendetaID)->get();

//     // Kembalikan view dengan data pendeta dan daftar pelayanan
//     return view('pendeta.dashboard', compact('pendeta', 'ibadah')); 
// }

    
}
