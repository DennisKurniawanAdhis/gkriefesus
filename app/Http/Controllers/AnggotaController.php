<?php
  
namespace App\Http\Controllers;
  
use App\Models\Kas;
use App\Models\Komisi;
use App\Models\Anggota;
use App\Models\Keahlian;
use App\Models\Pernikahan;
use App\Models\CalonBaptis;
use App\Models\JenisIbadah;
use Illuminate\Http\Request;
use App\Models\AlamatAnggota;
use App\Models\AnggotaIbadah;
use App\Models\AnggotaKeahlian;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



 
class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function alamat()
    {
        return $this->hasOne(AlamatAnggota::class);
    }

    public function keahlian()
    {
        return $this->hasMany(Keahlian::class);
    }

    public function jenisIbadah()
    {
        return $this->belongsToMany(JenisIbadah::class);
    }
    public function index(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' ) {
            return redirect()->back();
        }
        // Cek apakah ada input pencarian dari user
        $search = $request->input('search');
    
        // Query untuk mencari anggota berdasarkan nama depan atau belakang
        $query = Anggota::query();
        if ($search) {
            $query->where('namaDepanAnggota', 'LIKE', "%{$search}%")
                  ->orWhere('namaBelakangAnggota', 'LIKE', "%{$search}%");
        }
        $anggota = $query->simplePaginate(5);
    
        // Tambahkan search query ke URL pagination
        $anggota->appends(['search' => $search]);
    
        return view('anggota.index', compact('anggota', 'search'));
    }


 
  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' ) {
            return redirect()->back();
        }
        $jenisKelamin = Anggota::jenisKelamin;
        $statusKawin = Anggota::statusKawin;
        $jenisIbadah = JenisIbadah::all();
        $keahlian = Keahlian::all();

        return view('anggota.create', compact('jenisKelamin', 'statusKawin', 'jenisIbadah', 'keahlian'));
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    if (!Auth::check() || Auth::user()->role !== 'keanggotaan' ) {
        return redirect()->back();
    }
 
    $lastAnggota = Anggota::orderBy('anggotaID', 'desc')->first();
    if ($lastAnggota) {
        // Ekstrak bagian numerik dari ibadahID
        $lastNumber = intval(substr($lastAnggota->anggotaID, 1));
        
        // Tambahkan 1 ke nomor terakhir
        $newNumber = $lastNumber + 1;
        
        // Format ulang ibadahID dengan huruf 'B' di depan
        $anggotaID = 'A' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    } else {
        $anggotaID = 'A001';
    }
    


$anggota = new Anggota();
$anggota->anggotaID = $anggotaID;  
$anggota->noTelp = $request->noTelp;
$anggota->namaDepanAnggota = $request->namaDepanAnggota;
$anggota->namaBelakangAnggota = $request->namaBelakangAnggota;
$anggota->tanggalLahir = $request->tanggalLahir;
$anggota->tempatLahir = $request->tempatLahir;
$anggota->jenisKelamin = $request->jenisKelamin;
$anggota->statusKawin = $request->statusKawin;
$anggota->noKK = $request->noKK;
$anggota->NIK = $request->NIK;
$anggota->pekerjaan = $request->pekerjaan;
$anggota->save();  // Simpan data anggota

// Buat alamat baru dan simpan
$alamat = new AlamatAnggota();
$alamat->anggotaID = $anggotaID; // Pastikan foreign key sesuai
$alamat->kelurahan = $request->kelurahan;
$alamat->kecamatan = $request->kecamatan;
$alamat->kota = $request->kota;
$alamat->provinsi = $request->provinsi;
$alamat->namaJalan = $request->namaJalan;
$alamat->RT = $request->RT;
$alamat->RW = $request->RW;
$alamat->kodePos = $request->kodePos;
$alamat->save();  // Simpan data alamat

// Simpan jenis ibadah (Pastikan input ini benar dan terisi)
if ($request->has('jenisIbadah')) {
    $jenisIbadahData = $request->input('jenisIbadah');  // Array ibadahID dari form

    // Masukkan data ke junction table anggota_jenisIbadah
    foreach ($jenisIbadahData as $ibadahID) {
        DB::table('anggota_jenisIbadah')->insert([
            'anggotaID' => $anggotaID,  // Gunakan anggotaID yang baru disimpan
            'ibadahID' => $ibadahID,  // Data ibadahID dari form
        ]);
    }
}

// 4. Simpan data ke junction table 'anggota_keahlian'
// Ambil data keahlian dari form
if ($request->has('keahlian')) {
    $keahlianData = $request->input('keahlian');  // Array keahlianID dari form

    // Masukkan data ke junction table anggota_keahlian
    foreach ($keahlianData as $keahlianID) {
        DB::table('anggota_keahlian')->insert([
            'anggotaID' => $anggotaID,  // Gunakan anggotaID yang baru disimpan
            'keahlianID' => $keahlianID,  // Data keahlianID dari form
        ]);
    }

    
}

return redirect()->route('anggota')->with('success', 'Anggota added successfully');

}

  

    public function edit(string $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' ) {
            return redirect()->back();
        }
        $anggota = Anggota::where('anggotaID', $id)->firstOrFail();
        $jenisKelamin = Anggota::jenisKelamin;
        $statusKawin = Anggota::statusKawin;
        $jenisIbadah = JenisIbadah::all();
        $keahlian = Keahlian::all();
        $alamatAnggota = $anggota->alamat; 

        $selectedIbadah = DB::table('jenisIbadah')
        ->select('jenisIbadah.ibadahID') // Pastikan menggunakan nama kolom yang benar
        ->join('anggota_jenisIbadah', 'jenisIbadah.ibadahID', '=', 'anggota_jenisIbadah.ibadahID') // Ganti 'id' dengan 'ibadahID'
        ->where('anggota_jenisIbadah.anggotaID', $anggota->anggotaID) // Ganti null dengan ID anggota yang relevan
        ->pluck('jenisIbadah.ibadahID');


            // Mengambil keahlian yang sudah dipilih oleh anggota
            $selectedKeahlian = DB::table('keahlian')
            ->select('keahlian.keahlianID') // Menyebutkan tabel dengan jelas
            ->join('anggota_keahlian', 'keahlian.keahlianID', '=', 'anggota_keahlian.keahlianID') // Ubah 'id' menjadi 'keahlianID'
            ->where('anggota_keahlian.anggotaID', $anggota->anggotaID)
            ->pluck('keahlian.keahlianID');


            $someValue = 1; // ID yang ingin kita periksa

            if ($selectedIbadah->contains($someValue)) {
                // Lakukan sesuatu jika $someValue ditemukan dalam selectedIbadah
                $isSelected = true;
            } else {
                $isSelected = false;
            }

            $keahlianVlue = 1;

            if ($selectedKeahlian->contains($keahlianVlue)) { // Gunakan contains() untuk memeriksa Collection
                // Lakukan sesuatu jika ibadahID ditemukan dalam selectedIbadah
                $isSelected = true;
            } else {
                // Jika tidak ditemukan
                $isSelected = false;
            }
        
        return view('anggota.edit', compact('jenisKelamin', 'statusKawin', 'jenisIbadah', 'keahlian','alamatAnggota','selectedIbadah','selectedKeahlian','anggota'));
        
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' ) {
            return redirect()->back();
        }
        $anggota = Anggota::findOrFail($id);
        
        $anggota->update($request->all());

        if ($anggota->alamat) {
            $anggota->alamat->update($request->only([
                'namaJalan', 'RT', 'RW', 'kodePos', 'kelurahan', 'kecamatan', 'kota', 'provinsi'
            ]));
        }

        $anggota->jenisIbadah()->sync($request->input('jenisIbadah', []));
        $anggota->keahlian()->sync($request->input('keahlian', []));
  
        return redirect()->route('anggota')->with('success', 'Anggota updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' ) {
            return redirect()->back();
        }
        $anggota = Anggota::findOrFail($id);

        if ($anggota->komisiID !== null) {
            return redirect()->route('anggota')->with('warning', 'Tidak dapat menghapus Anggota ini karena masih terdaftar dalam komisi.');
        }

        $relatedRecords = CalonBaptis::where('anggotaID', $id)->count();
        $relatedRecordKas = Kas::where('anggotaID', $id)->count();
        $relatedRecordPernikahanSuami = Pernikahan::where('anggotaID_suami', $id)->count();
        $relatedRecordPernikahanIstri = Pernikahan::where('anggotaID_istri', $id)->count();
    
        if ($relatedRecords > 0 || $relatedRecordKas > 0 || $relatedRecordPernikahanSuami > 0 || $relatedRecordPernikahanIstri > 0 ) {
            return redirect()->route('anggota')->with('warning', 'Tidak dapat menghapus Anggota ini karena masih ada data yang menggunakannya.');
        }
        $anggota->delete();
  
        return redirect()->route('anggota')->with('success', 'Anggota deleted successfully');
    }

}