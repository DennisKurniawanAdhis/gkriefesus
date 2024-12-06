<?php
  
namespace App\Http\Controllers;

use App\Models\Keahlian;
use Illuminate\Http\Request;
use App\Models\AnggotaKeahlian;
use Illuminate\Support\Facades\Auth;
 
class KeahlianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' && Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }

        $keahlian = Keahlian::simplePaginate(5);
        return view('keahlian.index', compact('keahlian'));
    }
  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' && Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }
        return view('keahlian.create');
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' && Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }

        $lastKeahlian = Keahlian::orderBy('keahlianID', 'desc')->first();
        if ($lastKeahlian) {
            // Ekstrak bagian numerik dari ibadahID
            $lastNumber = intval(substr($lastKeahlian->keahlianID, 1));
            
            // Tambahkan 1 ke nomor terakhir
            $newNumber = $lastNumber + 1;
            
            // Format ulang ibadahID dengan huruf 'B' di depan
            $keahlianID = 'K' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        } else {
            $keahlianID = 'K001';
        }

        $keahlian = new Keahlian();
        $keahlian->keahlianID = $keahlianID; 
        $keahlian->namaKeahlian = $request->namaKeahlian;
        $keahlian->deskripsi = $request->deskripsi;
        $keahlian->save();  // Simpan data keahllian

        // Keahlian::create($request->all());
 
        return redirect()->route('keahlian')->with('success', 'Keahlian added successfully');
    }
  
    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     $keahlian = Keahlian::findOrFail($id);
  
    //     return view('keahlian.show', compact('keahlian'));
    // }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' && Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }
        $keahlian = Keahlian::findOrFail($id);
  
        return view('keahlian.edit', compact('keahlian'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' && Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }
        $keahlian = Keahlian::findOrFail($id);
  
        $keahlian->update($request->all());
  
        return redirect()->route('keahlian')->with('success', 'Keahlian updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' && Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }
        // Cek apakah keahlian yang ingin dihapus adalah K001
        if ($id === 'K001') {
            // Log informasi jika perlu
            // \Log::info('Attempt to delete K001');
            return redirect()->route('keahlian')->with('warning', 'Keahlian tidak dapat dihapus.');
        }
    
        // Periksa apakah ada data terkait di tabel anggota_keahlian
        $relatedRecords = AnggotaKeahlian::where('keahlianID', $id)->count();
    
        if ($relatedRecords > 0) {
            return redirect()->route('keahlian')->with('warning', 'Tidak dapat menghapus keahlian ini karena masih ada data yang menggunakannya.');
        }
    
        // Jika tidak ada data terkait, lanjutkan untuk menghapus keahlian
        $keahlian = Keahlian::findOrFail($id);
        $keahlian->delete();
    
        return redirect()->route('keahlian')->with('success', 'Keahlian deleted successfully');
    }
}