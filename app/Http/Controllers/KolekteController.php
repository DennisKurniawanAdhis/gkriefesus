<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use App\Models\Ibadah;
use App\Models\Anggota;
use App\Models\JenisIbadah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KolekteController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * 
     */
//     public function index(Request $request)
// {
    

//     // $kolekte = Kas::with('jenisIbadah')->where('jenisUang', 'kolekte')->get();
//     return view('kolekte.index', compact('kolekte'));
// }

public function index(Request $request)
{

    if (!Auth::check() || Auth::user()->role !== 'keuangan' && Auth::user()->role !== 'super' ) {
        return redirect()->back();
    }
    
    // Query dasar untuk data kolekte
    $query = Kas::with('jenisIbadah')->where('jenisUang', 'kolekte');

    // Cek apakah ada filter nama ibadah yang dikirim melalui request
    if ($request->filled('namaIbadah')) {
        // Filter berdasarkan nama ibadah
        $query->whereHas('jenisIbadah', function($q) use ($request) {
            $q->where('namaIbadah', $request->namaIbadah);
        });
    }

    // Eksekusi query dan dapatkan data kolekte
    $kolekte = $query->simplePaginate(5);

    // Ambil semua data jenis ibadah untuk dropdown filter
    $allIbadah = JenisIbadah::all();

    // Return view dengan data kolekte dan allIbadah
    return view('kolekte.index', compact('kolekte', 'allIbadah'));
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
        $ibadah = Ibadah::with(['jenisIbadah'])
    ->whereNotExists(function ($query) {
        $query->select(DB::raw(1))
              ->from('kas')
              ->whereRaw('kas.dataIbadahID = ibadah.dataIbadahID')
              ->where('kas.jenisUang', 'kolekte');
    })
    ->get();
        $jenisIbadah = JenisIbadah::all();

        if ($ibadah->isEmpty()) {
            return redirect()->back()->with('error', 'Belum ada data ibadah yang tersedia.');
        }
    

        return view('kolekte.create', compact('jenisIbadah','ibadah'));
    }

    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'keuangan' && Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }
        
        $request->validate([
            'jumlahUang' => 'required|integer|min:1',
        ]);
        // Ambil data ibadah berdasarkan dataIbadahID yang dipilih
        $ibadah = Ibadah::with('jenisIbadah')->find($request->dataIbadahID);
        
        // Buat instance baru dari model Kas
        $kolekte = new Kas();
        
        // Set nilai-nilai yang akan disimpan
        $kolekte->ibadahID = $ibadah->jenisIbadah->ibadahID; // Mengambil ID dari jenis ibadah
        $kolekte->dataIbadahID = $request->dataIbadahID;
        $kolekte->tanggal = $ibadah->tanggalIbadah;
        $kolekte->jenisUang = 'kolekte';
        $kolekte->jumlahUang = $request->jumlahUang;
        
        // Simpan data ke database
        $kolekte->save();
    
        return redirect()->route('kolekte')->with('success', 'Kolekte added successfully');
    }


    public function edit(string $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'keuangan' && Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }
        
        // Ambil data kolekte yang akan diedit beserta relasinya
        $kolekte = Kas::with(['ibadah.jenisIbadah'])->where('kasID', $id)->firstOrFail();
    
        // Ambil data ibadah terpilih beserta relasi jenisIbadah
        $ibadahTerpilih = Ibadah::with('jenisIbadah')
                                ->where('dataIbadahID', $kolekte->dataIbadahID)
                                ->first();
    
        // Ambil dataIbadahID yang sudah ada di tabel kas kecuali data yang sedang diedit
        $existingKas = Kas::where('jenisUang', 'kolekte')
                          ->where('kasID', '!=', $id)
                          ->pluck('dataIbadahID');
    
        // Ambil semua data ibadah beserta jenisIbadah yang belum ada di tabel kas
        $ibadah = Ibadah::with('jenisIbadah')
                        ->whereNotIn('dataIbadahID', $existingKas)
                        ->orWhere('dataIbadahID', $kolekte->dataIbadahID)
                        ->get();
    
        $jumlahUangFormatted = intval($kolekte->jumlahUang);
    
        return view('kolekte.edit', compact('kolekte', 'ibadahTerpilih', 'ibadah', 'jumlahUangFormatted'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'keuangan' && Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }
        

        $request->validate([
            'jumlahUang' => 'required|integer|min:1',
        ]);

        // Validasi data yang masuk
        $kolekte = Kas::findOrFail($id);
    
        // Mengubah nilai jumlahUang menjadi integer jika perlu
        $kolekte->jumlahUang = (int) str_replace('.', '', $request->jumlahUang);
    
        $kolekte->update($request->all());
    
        return redirect()->route('kolekte')->with('success', 'Kolekte updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'keuangan' && Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }
        
        $kolekte = Kas::findOrFail($id);
  
        $kolekte->delete();
  
        return redirect()->route('kolekte')->with('success', 'Kolekte deleted successfully');
    }
}
