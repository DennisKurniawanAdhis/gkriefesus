<?php
  
namespace App\Http\Controllers;


use App\Models\Kas;
use App\Models\Ibadah;
use App\Models\JenisIbadah;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use App\Models\AnggotaIbadah;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
 
class jenisIbadahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' && Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }

        $jenisIbadah = jenisIbadah::simplePaginate(5);
      
        return view('jenisIbadah.index', compact('jenisIbadah'));
    }
  
    /**
     * Show the form for creating a new resource.
     */
    public function create()

    {   

        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' && Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }
        $hari = JenisIbadah::hari;
        return view('jenisIbadah.create', compact('hari'));
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' && Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }

        $request->validate([
            'namaIbadah' => 'required|string|max:255',
            'hari' => 'required|string|max:255',
            'waktu' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $lastJenisIbadah = JenisIbadah::orderBy('ibadahID', 'desc')->first();
        if ($lastJenisIbadah) {
            // Ekstrak bagian numerik dari ibadahID
            $lastNumber = intval(substr($lastJenisIbadah->ibadahID, 1));
            
            // Tambahkan 1 ke nomor terakhir
            $newNumber = $lastNumber + 1;
            
            // Format ulang ibadahID dengan huruf 'B' di depan
            $ibadahID = 'B' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        } else {
            $ibadahID = 'B001';
        }
        
        
        $ibadah = new JenisIbadah();
        $ibadah->ibadahID = $ibadahID; 
        $ibadah->namaIbadah = $request->namaIbadah;
        $ibadah->hari = $request->hari;
        $ibadah->waktu = $request->waktu;
        $ibadah->lokasi = $request->lokasi;
        $ibadah->deskripsi = $request->deskripsi;
        $ibadah->save();  // Simpan data keahllian

 
        return redirect()->route('jenisIbadah')->with('success', 'Jenis Ibadah added successfully');
    }
  
    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     $jenisIbadah = JenisIbadah::findOrFail($id);
  
    //     return view('jenisIbadah.show', compact('jenisIbadah'));
    // }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

       if (!Auth::check() || Auth::user()->role !== 'keanggotaan' && Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }
        $hari = JenisIbadah::hari;
        
        $jenisIbadah = JenisIbadah::findOrFail($id); // Pastikan Anda mengambil data yang tepat
      
        return view('jenisIbadah.edit', compact('jenisIbadah', 'hari'));
    }
    
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' && Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }
        $jenisIbadah = JenisIbadah::findOrFail($id);
  
        $jenisIbadah->update($request->all());
  
        return redirect()->route('jenisIbadah')->with('success', 'Jenis Ibadah updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' && Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }
        if ($id === 'B001') {
            // Log::info('Attempt to delete B001');
            // Tambahkan logging untuk memastikan kondisi ini terpenuhi
            // \Log::info('Warning should appear for B001');
            return redirect()->route('jenisIbadah')->with('warning', 'Jenis Ibadah tidak dapat dihapus.');
        }
        // Periksa apakah ada data terkait
        $relatedRecords = AnggotaIbadah::where('ibadahID', $id)->count();
        $relatedRecordIbadah = Ibadah::where('ibadahID', $id)->count();
        $relatedRecordKas = Kas::where('ibadahID', $id)->count();
        $relatedRecordPengeluaran = Pengeluaran::where('ibadahID', $id)->count();
    
        if ($relatedRecords > 0 || $relatedRecordIbadah > 0 || $relatedRecordKas > 0 || $relatedRecordPengeluaran > 0) {
            return redirect()->route('jenisIbadah')->with('warning', 'Tidak dapat menghapus jenis ibadah ini karena masih ada data yang menggunakannya.');
        
        }
    
        // Jika tidak ada data terkait, lanjutkan untuk menghapus
        $jenisIbadah = JenisIbadah::findOrFail($id);
        $jenisIbadah->delete();
    
        return redirect()->route('jenisIbadah')->with('success', 'Jenis Ibadah deleted successfully');
    }
}