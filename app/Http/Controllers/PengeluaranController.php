<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use App\Models\Anggota;
use App\Models\JenisIbadah;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    //     $pengeluaran = Pengeluaran::with(['jenisIbadah'])->get();
        

    //     return view('pengeluaran.index', data: compact('pengeluaran'));
    // }

    public function index(Request $request)
{
    
    if (!Auth::check() || Auth::user()->role !== 'keuangan' && Auth::user()->role !== 'super' ) {
        return redirect()->back();
    }
    

    // Query dasar untuk data pengeluaran
    $query = Pengeluaran::with('jenisIbadah');

    // Filter berdasarkan jenis pengeluaran
    if ($request->filled('filterPengeluaran')) {
        if ($request->filterPengeluaran === 'kas') {
            $query->whereNull('ibadahID');
        } else {
            $query->whereHas('jenisIbadah', function ($q) use ($request) {
                $q->where('namaIbadah', $request->filterPengeluaran);
            });
        }
    }

    // Ambil semua jenis ibadah untuk dropdown filter
    $jenisIbadah = JenisIbadah::all();

    // Eksekusi query dan urutkan tanggal pengeluaran terbaru
    $pengeluaran = $query->orderBy('tanggal', 'desc')->simplePaginate(5);

    // Menambahkan parameter filter ke pagination links
    $pengeluaran->appends($request->except('page'));

    // Return view dengan data pengeluaran dan jenis ibadah untuk filter
    return view('pengeluaran.index', compact('pengeluaran', 'jenisIbadah'));
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
        $ibadah = JenisIbadah::all();

        return view('pengeluaran.create', compact('ibadah'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'keuangan' && Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }
        
        // Validasi input
        $request->validate([
            'jumlahUang' => 'required|integer|min:1',
        ]);
    
        // Cek jika jenis pengeluaran adalah 'kas'
        if ($request->ibadahID === 'kas') {
            // Simpan data pengeluaran sebagai kas
            Pengeluaran::create([
                'ibadahID' => null, // Set ibadahID ke null untuk kas
                'tanggal' => $request->tanggal,
                'deskripsi' => $request->deskripsi,
                'jenisPengeluaran' => 'kas', // Menyimpan 'Kas' sebagai jenisPengeluaran
                'jumlahUang' => $request->jumlahUang
            ]);
        } else {
            // Jika bukan kas, pastikan ibadahID valid
            $request->validate([
                'ibadahID' => 'required|exists:jenisIbadah,ibadahID' // Validasi ibadahID jika tidak kas
            ]);
    
            // Ambil nama ibadah berdasarkan ibadahID
            $namaIbadah = JenisIbadah::where('ibadahID', $request->ibadahID)->value('namaIbadah');
    
            // Simpan data pengeluaran dengan namaIbadah sebagai jenisPengeluaran
            Pengeluaran::create([
                'ibadahID' => $request->ibadahID,
                'tanggal' => $request->tanggal,
                'deskripsi' => $request->deskripsi,
                'jenisPengeluaran' => 'kolekte', // Menyimpan namaIbadah sebagai jenisPengeluaran
                'jumlahUang' => $request->jumlahUang
            ]);
        }

    
        return redirect()->route('pengeluaran')->with('success', 'Pengeluaran added successfully');
    }
    
    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     // Temukan pengeluaran berdasarkan ID
    //     $pengeluaran = Pengeluaran::with(['jenisIbadah'])->findOrFail($id);
    
    //     return view('pengeluaran.show', compact('pengeluaran'));
    // }
    


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'keuangan' && Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }
        
        // Temukan pengeluaran berdasarkan ID
        $pengeluaran = Pengeluaran::findOrFail($id);
        // Ambil semua jenis ibadah
        $ibadah = JenisIbadah::all();

        $jumlahUangFormatted = intval($pengeluaran->jumlahUang);
    
        $tanggalFormatted = $pengeluaran->tanggal ? $pengeluaran->tanggal->format('Y-m-d') : null;
        return view('pengeluaran.edit', compact('pengeluaran', 'ibadah','jumlahUangFormatted','tanggalFormatted'));
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
    
        // Temukan pengeluaran yang ingin diupdate
        $pengeluaran = Pengeluaran::findOrFail($id);
    
        // Cek jika jenis pengeluaran adalah 'kas'
        if ($request->ibadahID === 'kas') {
            // Update data pengeluaran sebagai kas
            $pengeluaran->update([
                'ibadahID' => null, // Set ibadahID ke null untuk kas
                'tanggal' => $request->tanggal,
                'deskripsi' => $request->deskripsi,
                'jenisPengeluaran' => 'kas', // Menyimpan 'Kas' sebagai jenisPengeluaran
                'jumlahUang' => $request->jumlahUang
            ]);
        } else {
            // Jika bukan kas, pastikan ibadahID valid
            $request->validate([
                'ibadahID' => 'required|exists:jenisIbadah,ibadahID' // Validasi ibadahID jika tidak kas
            ]);
    
            // Ambil nama ibadah berdasarkan ibadahID
            $namaIbadah = JenisIbadah::where('ibadahID', $request->ibadahID)->value('namaIbadah');
    
            // Update data pengeluaran dengan namaIbadah sebagai jenisPengeluaran
            $pengeluaran->update([
                'ibadahID' => $request->ibadahID,
                'tanggal' => $request->tanggal,
                'deskripsi' => $request->deskripsi,
                'jenisPengeluaran' => 'kolekte', // Menyimpan namaIbadah sebagai jenisPengeluaran
                'jumlahUang' => $request->jumlahUang
            ]);
        }
    
        return redirect()->route('pengeluaran')->with('success', 'Pengeluaran updated successfully');
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'keuangan' && Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }
        
        $pengeluaran = Pengeluaran::findOrFail($id);
  
        $pengeluaran->delete();
  
        return redirect()->route('pengeluaran')->with('success', 'Pengeluaran deleted successfully');
        //
    }
}
