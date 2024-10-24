<?php
  
namespace App\Http\Controllers;
  
use App\Models\Anggota;
use App\Models\Keahlian;
use App\Models\JenisIbadah;
use Illuminate\Http\Request;
use App\Models\AlamatAnggota;
use App\Models\AnggotaIbadah;
use App\Models\AnggotaKeahlian;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;


// trait GenerateAnggotaID
// {
//     public static function generateAnggotaID()
//     {
//         // Get the last anggota ID
//         $lastAnggota = Anggota::orderBy('anggotaID', 'desc')->first();
        
//         if (!$lastAnggota) {
//             // If no anggota exists yet, start with A001
//             return 'A001';
//         }
        
//         // Extract the numeric part
//         $lastNumber = intval(substr($lastAnggota->anggotaID, 1));
        
//         // Increment and pad with zeros
//         $newNumber = $lastNumber + 1;
//         return 'A' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
//     }
// }
 
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
        // Cek apakah ada input pencarian dari user
        $search = $request->input('search');
    
        // Query untuk mencari anggota berdasarkan nama depan atau belakang
        $anggota = Anggota::where('namaDepanAnggota', 'LIKE', "%{$search}%")
                    ->orWhere('namaBelakangAnggota', 'LIKE', "%{$search}%")
                    ->get();
    
        return view('anggota.index', compact('anggota'));
    }
    
  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        
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
    // Buat anggota baru dan simpan
$anggota = new Anggota();
$anggota->anggotaID = $request->anggotaID;  // Pastikan anggotaID sesuai dengan input yang benar
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
$alamat->anggotaID = $anggota->anggotaID; // Pastikan foreign key sesuai
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
            'anggotaID' => $anggota->anggotaID,  // Gunakan anggotaID yang baru disimpan
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
            'anggotaID' => $anggota->anggotaID,  // Gunakan anggotaID yang baru disimpan
            'keahlianID' => $keahlianID,  // Data keahlianID dari form
        ]);
    }

    
}

return redirect()->route('anggota')->with('success', 'Anggota added successfully');

}

  
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anggota = Anggota::with('keahlian', 'jenisIbadah','komisi')->findOrFail($id); // pastikan $id adalah id anggota

        $alamat = $anggota->alamat;
    $jenisIbadah = $anggota->jenisIbadah->pluck('namaIbadah')->implode(', ');
    $keahlian = $anggota->keahlian->pluck('namaKeahlian')->implode(', ');

    
        return view('anggota.show', compact('anggota','alamat','keahlian','jenisIbadah'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
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
        $anggota = Anggota::findOrFail($id);
  
        $anggota->delete();
  
        return redirect()->route('anggota')->with('success', 'Anggota deleted successfully');
    }

}