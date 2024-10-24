<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use App\Models\Anggota;
use App\Models\JenisIbadah;
use Illuminate\Http\Request;

class SumbanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $sumbangan = Kas::where('jenisUang', 'sumbangan')->get();
    return view('sumbangan.index', compact('sumbangan'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
       
        return view('sumbangan.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $sumbangan = new Kas();
$sumbangan->namaPenyumbang = $request->namaPenyumbang;
$sumbangan->jumlahUang = $request->jumlahUang;
$sumbangan->jenisUang = 'sumbangan';
$sumbangan->tanggal = $request->tanggal;
$sumbangan->deskripsi = $request->deskripsi;
$sumbangan->save();  // Simpan data anggota

// Buat alamat baru dan simpan


return redirect()->route('sumbangan')->with('success', 'Kolekte added successfully');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $sumbangan = Kas::findOrFail($id);

        

        return view('sumbangan.show', compact('sumbangan'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sumbangan = Kas::where('kasID', $id)->firstOrFail();
       
        $jumlahUangFormatted = intval($sumbangan->jumlahUang);

        return view('sumbangan.edit', compact('sumbangan','jumlahUangFormatted'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang masuk
        $request->validate([
    
            'tanggal' => 'required|date',
            'jumlahUang' => 'required|numeric', // Pastikan jumlahUang adalah angka
         
        ]);
    
        $sumbangan = Kas::findOrFail($id);
    
        // Mengubah nilai jumlahUang menjadi integer jika perlu
        $sumbangan->jumlahUang = (int) str_replace('.', '', $request->jumlahUang);
    
        $sumbangan->update($request->all());
    
        return redirect()->route('sumbangan')->with('success', 'Sumbangan updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sumbangan = Kas::findOrFail($id);
  
        $sumbangan->delete();
  
        return redirect()->route('sumbangan')->with('success', 'Sumbangan deleted successfully');
    }
}
