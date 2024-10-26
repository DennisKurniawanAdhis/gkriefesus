<?php

namespace App\Http\Controllers;

use App\Models\Ibadah;
use App\Models\JenisIbadah;
use App\Models\Pendeta;
use Illuminate\Http\Request;

class IbadahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    //      //
    //      $ibadah = Ibadah::with(['jenisIbadah', 'pendeta'])->get();

    //      return view('ibadah.index', compact('ibadah'));
    // }

    public function index(Request $request)
{
    $jenisIbadahID = $request->get('ibadahID');

    // Ambil data semua jenis ibadah untuk dropdown
    $jenisIbadah = JenisIbadah::all();

    // Jika filter dipilih, tampilkan ibadah berdasarkan jenisIbadahID
    if ($jenisIbadahID) {
        $ibadah = Ibadah::where('ibadahID', $jenisIbadahID)->get();
    } else {
        // Jika tidak ada filter, tampilkan semua ibadah
        $ibadah = Ibadah::all();
    }

    return view('ibadah.index', compact('ibadah', 'jenisIbadah'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    
        $pendeta = Pendeta::all();
        $ibadah = JenisIbadah::all();


        if ($pendeta->isEmpty() || $ibadah->isEmpty()) {
            return redirect()->back()->with('error', 'Belum ada pendeta ataupun data ibadah');
        }
        return view('ibadah.create', compact('pendeta','ibadah'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
$ibadah = new Ibadah();
$ibadah->ibadahID = $request->ibadahID;
$ibadah->pendetaID = $request->pendetaID;
$ibadah->tanggalIbadah = $request->tanggalIbadah;
$ibadah->deskripsi = $request->deskripsi;
$ibadah->save();  // Simpan data anggota

// Buat alamat baru dan simpan


return redirect()->route('ibadah')->with('success', 'Baptis added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $dataIbadah = Ibadah::with(['jenisIbadah','pendeta'])->findOrFail($id);    
        

        return view('ibadah.show', compact('dataIbadah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dataIbadah = Ibadah::where('dataIbadahID', $id)->firstOrFail();

        $jenisIbadahTerpilih = JenisIbadah::where('ibadahID', $dataIbadah->ibadahID)->first();
    
        // Ambil data pendeta lainnya (semua pendeta untuk dropdown)
        $jenisIbadah = JenisIbadah::all();

        //
        //
        $pendetaTerpilih = Pendeta::where('pendetaID', $dataIbadah->pendetaID)->first();
    
        // Ambil data pendeta lainnya (semua pendeta untuk dropdown)
        $pendeta = Pendeta::all();

       

        return view('ibadah.edit', compact('pendeta','dataIbadah','pendetaTerpilih', 'jenisIbadahTerpilih','jenisIbadah'));

        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $dataIbadahID = Ibadah::findOrFail($id);
        
        $dataIbadahID->update($request->all());


        return redirect()->route('ibadah')->with('success', 'Ibadah updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataIbadah = Ibadah::findOrFail($id);
  
        $dataIbadah->delete();
  
        return redirect()->route('dataIbadah')->with('success', 'Ibadah deleted successfully');
        //
    }
}
