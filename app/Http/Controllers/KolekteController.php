<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use App\Models\Ibadah;
use App\Models\Anggota;
use App\Models\JenisIbadah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    $kolekte = $query->get();

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

// public function store(Request $request)
// {
//     // Validasi data
//     $request->validate([
//         'dataIbadahID' => 'required|exists:ibadah,dataIbadahID', // Pastikan ID valid
//         'jumlahUang' => 'required|numeric|min:0', // Validasi jumlah uang
//         'tanggalIbadah' => 'required|date', // Validasi tanggal
//     ]);

//     // Membuat instance baru untuk menyimpan kolekte
//     $kolekte = new Kas();
//     $kolekte->dataIbadahID = $request->dataIbadahID; // Menggunakan nama yang konsisten
//     $kolekte->jumlahUang = $request->jumlahUang;
//     $kolekte->jenisUang = 'kolekte';
//     $kolekte->tanggal = $request->tanggalIbadah; // Simpan tanggal Ibadah dari form
//     $kolekte->save(); // Simpan data kolekte

//     return redirect()->route('kolekte')->with('success', 'Kolekte added successfully');
// }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $kolekte = Kas::with(['jenisIbadah'])->findOrFail($id);    
        

        return view('kolekte.show', compact('kolekte'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
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
        $kolekte = Kas::findOrFail($id);
  
        $kolekte->delete();
  
        return redirect()->route('kolekte')->with('success', 'Kolekte deleted successfully');
    }
}
