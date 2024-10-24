<?php
  
namespace App\Http\Controllers;
  
use App\Models\Komisi;
use App\Models\Anggota;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
 
class KomisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $komisi = Komisi::with(['anggota'])->get();

         return view('komisi.index', compact('komisi'));
    }
  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $anggota = Anggota::whereNull('komisiID')->get();
    
        // Kirim data anggota ke view
        return view('komisi.create', compact('anggota'));
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'komisiID' => 'required|unique:komisi,komisiID',
            'namaKomisi' => 'required|string|max:255',
            'ketua' => 'required|exists:anggota,anggotaID',
            'wakil_ketua' => 'required|exists:anggota,anggotaID',
            'bendahara' => 'required|exists:anggota,anggotaID',
            'sekretaris' => 'required|exists:anggota,anggotaID',
            'deskripsi' => 'required|string',
        ]);
    
        // Simpan data Komisi
        $komisi = new Komisi();
        $komisi->komisiID = $request->komisiID;
        $komisi->namaKomisi = $request->namaKomisi;
        $komisi->deskripsi = $request->deskripsi;
        $komisi->save();
    
        // Update jabatan anggota yang terpilih
        // Misalkan tabel `anggota` memiliki kolom `komisiID` dan `jabatan`
        
        // Update Ketua
        $ketua = Anggota::find($request->ketua);
        $ketua->komisiID = $komisi->komisiID;
        $ketua->jabatan = 'Ketua';
        $ketua->save();
    
        // Update Wakil Ketua
        $wakil_ketua = Anggota::find($request->wakil_ketua);
        $wakil_ketua->komisiID = $komisi->komisiID;
        $wakil_ketua->jabatan = 'Wakil Ketua';
        $wakil_ketua->save();
    
        // Update Bendahara
        $bendahara = Anggota::find($request->bendahara);
        $bendahara->komisiID = $komisi->komisiID;
        $bendahara->jabatan = 'Bendahara';
        $bendahara->save();
    
        // Update Sekretaris
        $sekretaris = Anggota::find($request->sekretaris);
        $sekretaris->komisiID = $komisi->komisiID;
        $sekretaris->jabatan = 'Sekretaris';
        $sekretaris->save();
    
        // Redirect atau beri response sukses
        return redirect()->route('komisi')->with('success', 'Komisi dan jabatannya berhasil disimpan.');
    }
  
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $komisi = Komisi::with(['anggota'])->findOrFail($id);    

        $ketua = $komisi->anggota->where('jabatan', 'Ketua')->first();
        $wakilKetua = $komisi->anggota->where('jabatan', 'Wakil Ketua')->first();
        $bendahara = $komisi->anggota->where('jabatan', 'Bendahara')->first();
        $sekretaris = $komisi->anggota->where('jabatan', 'Sekretaris')->first();

  
        return view('komisi.show', compact('komisi','ketua','wakilKetua','bendahara','sekretaris'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $komisi = Komisi::where('komisiID', $id)->firstOrFail();


// Mendapatkan anggota yang terpilih sebagai ketua
$ketuaTerpilih = Anggota::where('komisiID', $komisi->komisiID)
->where('jabatan', 'ketua')
->first();

$wakilTerpilih = Anggota::where('komisiID', $komisi->komisiID)
->where('jabatan', 'wakil ketua')
->first();



$bendaharaTerpilih = Anggota::where('komisiID', $komisi->komisiID)
->where('jabatan', 'bendahara')
->first();


$sekretarisTerpilih = Anggota::where('komisiID', $komisi->komisiID)
->where('jabatan', 'sekretaris')
->first();


    

// Ambil semua anggota untuk dropdown
$anggota = Anggota::whereNull('komisiID')
                  ->orWhereNull('jabatan')
                  ->orWhere('komisiID', $komisi->komisiID)
                  ->get();



// Tampilkan halaman edit dengan data komisi
        return view('komisi.edit', compact('komisi', 'anggota','ketuaTerpilih','wakilTerpilih','bendaharaTerpilih','sekretarisTerpilih'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Temukan komisi berdasarkan ID
        $komisi = Komisi::findOrFail($id);
    
        // Update data komisi
        $komisi->update($request->all());
    
        // Update jabatan anggota (ketua, wakil ketua, bendahara, sekretaris)
        // Reset anggota yang sebelumnya menjabat pada komisi ini
        Anggota::where('komisiID', $komisi->komisiID)
               ->whereIn('jabatan', ['Ketua', 'Wakil ketua', 'Bendahara', 'Sekretaris'])
               ->update(['komisiID' => null, 'jabatan' => null]);
    
        // Set anggota baru berdasarkan input request
        if ($request->ketua) {
            Anggota::where('anggotaID', $request->ketua)
                   ->update(['komisiID' => $komisi->komisiID, 'jabatan' => 'Ketua']);
        }
    
        if ($request->wakil_ketua) {
            Anggota::where('anggotaID', $request->wakil_ketua)
                   ->update(['komisiID' => $komisi->komisiID, 'jabatan' => 'Wakil Ketua']);
        }
    
        if ($request->bendahara) {
            Anggota::where('anggotaID', $request->bendahara)
                   ->update(['komisiID' => $komisi->komisiID, 'jabatan' => 'Bendahara']);
        }
    
        if ($request->sekretaris) {
            Anggota::where('anggotaID', $request->sekretaris)
                   ->update(['komisiID' => $komisi->komisiID, 'jabatan' => 'Sekretaris']);
        }
    
        // Redirect dengan pesan sukses
        return redirect()->route('komisi')->with('success', 'Komisi dan anggota berhasil diperbarui');
    }
    
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $komisi = Komisi::findOrFail($id);
        Anggota::where('komisiID', $id)->update(['jabatan' => null]);
        $komisi->delete();
  
        return redirect()->route('komisi')->with('success', 'komisi deleted successfully');
    }
}