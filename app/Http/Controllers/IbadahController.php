<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use App\Models\Ibadah;
use App\Models\Pendeta;
use App\Models\JenisIbadah;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' ) {
            return redirect()->back();
        }
        
        // Ambil parameter filter dari request
        $jenisIbadahID = $request->get('ibadahID');
        
        // Ambil data semua jenis ibadah untuk dropdown
        $jenisIbadah = JenisIbadah::all(); // Mengambil semua jenis ibadah untuk dropdown
    
        // if ($jenisIbadah->isEmpty()) {
        //     return redirect()->back()->with('error', 'Belum ada jenis ibadah yang tersedia.');
        // }
 

        // Jika filter dipilih, tampilkan ibadah berdasarkan jenisIbadahID
        if ($jenisIbadahID) {
            $ibadah = Ibadah::where('ibadahID', $jenisIbadahID)->simplePaginate(5);
        } else {
            // Jika tidak ada filter, tampilkan semua ibadah
            $ibadah = Ibadah::simplePaginate(5);
        }
    
        // Menambahkan parameter filter ke pagination, termasuk ibadahID
        $ibadah->appends(['ibadahID' => $jenisIbadahID]);
    
        return view('ibadah.index', compact('ibadah', 'jenisIbadah'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' ) {
            return redirect()->back();
        }
    
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

        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' ) {
            return redirect()->back();
        }
        //
$ibadah = new Ibadah();
$ibadah->ibadahID = $request->ibadahID;
$ibadah->pendetaID = $request->pendetaID;
$ibadah->tanggalIbadah = $request->tanggalIbadah;
$ibadah->deskripsi = $request->deskripsi;
$ibadah->save();  // Simpan data anggota

// Buat alamat baru dan simpan


return redirect()->route('ibadah')->with('success', 'Ibadah added successfully');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    //     $dataIbadah = Ibadah::with(['jenisIbadah','pendeta'])->findOrFail($id);    
        

    //     return view('ibadah.show', compact('dataIbadah'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' ) {
            return redirect()->back();
        }

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

        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' ) {
            return redirect()->back();
        }
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

        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' ) {
            return redirect()->back();
        }
        
        $dataIbadah = Ibadah::findOrFail($id);

        $relatedRecords = Kas::where('dataIbadahID', $id)->count();
    
        if ($relatedRecords > 0  ) {
            return redirect()->route('ibadah')->with('warning', 'Tidak dapat menghapus ibadah ini karena masih ada data yang menggunakannya.');
        }
  
        $dataIbadah->delete();
  
        return redirect()->route('ibadah')->with('success', 'Ibadah deleted successfully');
        //
    }
}
