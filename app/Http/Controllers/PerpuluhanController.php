<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use App\Models\Anggota;
use App\Models\JenisIbadah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PerpuluhanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    if (!Auth::check() || Auth::user()->role !== 'keuangan' && Auth::user()->role !== 'super' ) {
        return redirect()->back();
    }
    
    $query = Kas::with('anggota')->where('jenisUang', 'perpuluhan');
    
    // Filter berdasarkan anggotaID
    if ($request->has('anggotaID') && $request->anggotaID != '') {
        $query->where('anggotaID', $request->anggotaID);
    }
    
    $perpuluhan = $query->simplePaginate(5);
    
    // Ambil daftar anggota untuk dropdown
    $daftarAnggota = Anggota::select('anggotaID', DB::raw("CONCAT(namaDepanAnggota, ' ', COALESCE(namaBelakangAnggota, '')) AS nama_lengkap"))
        ->orderBy('nama_lengkap')
        ->pluck('nama_lengkap', 'anggotaID');

    return view('perpuluhan.index', compact('perpuluhan', 'daftarAnggota'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check() || Auth::user()->role !== 'keuangan' && Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }
        
        // 
        $anggota = Anggota::all();
        if ($anggota->isEmpty()) {
            return redirect()->back()->with('error', 'Belum ada data anggota yang tersedia.');
        }
    
        return view('perpuluhan.create', compact('anggota'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'keuangan' && Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }
        

        $request->validate([
            'jumlahUang' => 'required|integer|min:1',
        ]);
        

        $perpuluhan = new Kas();
$perpuluhan->anggotaID = $request->anggotaID;
$perpuluhan->jumlahUang = $request->jumlahUang;
$perpuluhan->jenisUang = 'perpuluhan';
$perpuluhan->tanggal = $request->tanggal;
$perpuluhan->save();  // Simpan data anggota

// Buat alamat baru dan simpan


return redirect()->route('perpuluhan')->with('success', 'Perpuluhan added successfully');


    }

    public function edit(string $id)
    {

        if (!Auth::check() || Auth::user()->role !== 'keuangan' && Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }
        
        $perpuluhan = Kas::where('kasID', $id)->firstOrFail();
        $anggotaTerpilih = Anggota::where('anggotaID', $perpuluhan->anggotaID)->first();
        $anggota = Anggota::all();
    
        $jumlahUangFormatted = intval($perpuluhan->jumlahUang);

        return view('perpuluhan.edit', compact('perpuluhan','anggotaTerpilih','anggota','jumlahUangFormatted'));

        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        if (!Auth::check() || Auth::user()->role !== 'keuangan' && Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }
        
        // Validasi data yang masuk
        $request->validate([
            'jumlahUang' => 'required|integer|min:1',
        ]);

        $perpuluhan = Kas::findOrFail($id);
    
        // Mengubah nilai jumlahUang menjadi integer jika perlu
        $perpuluhan->jumlahUang = (int) str_replace('.', '', $request->jumlahUang);
    
        $perpuluhan->update($request->all());
    
        return redirect()->route('perpuluhan')->with('success', 'Perpuluhan updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'keuangan' && Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }
        
        $perpuluhan = Kas::findOrFail($id);
  
        $perpuluhan->delete();
  
        return redirect()->route('perpuluhan')->with('success', 'Perpuluhan deleted successfully');
        //
    }
}
