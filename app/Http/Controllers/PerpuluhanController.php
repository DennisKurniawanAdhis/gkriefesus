<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use App\Models\Anggota;
use App\Models\JenisIbadah;
use Illuminate\Http\Request;

class PerpuluhanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $perpuluhan = Kas::with('anggota')->where('jenisUang', 'perpuluhan')->get();

        return view('perpuluhan.index', compact('perpuluhan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
        
        $perpuluhan = new Kas();
$perpuluhan->anggotaID = $request->anggotaID;
$perpuluhan->jumlahUang = $request->jumlahUang;
$perpuluhan->jenisUang = 'perpuluhan';
$perpuluhan->tanggal = $request->tanggal;
$perpuluhan->save();  // Simpan data anggota

// Buat alamat baru dan simpan


return redirect()->route('perpuluhan')->with('success', 'Perpuluhan added successfully');


    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    //     $perpuluhan = Kas::with(['anggota'])->findOrFail($id);    
        

    //     return view('perpuluhan.show', compact('perpuluhan'));
    // }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
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
        // Validasi data yang masuk
        $request->validate([
            'anggotaID' => 'required',
            'tanggal' => 'required|date',
            'jumlahUang' => 'required|numeric', // Pastikan jumlahUang adalah angka
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
        $perpuluhan = Kas::findOrFail($id);
  
        $perpuluhan->delete();
  
        return redirect()->route('perpuluhan')->with('success', 'Perpuluhan deleted successfully');
        //
    }
}
