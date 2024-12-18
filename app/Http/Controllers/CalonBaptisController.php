<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pendeta;
use App\Models\CalonBaptis;
use Illuminate\Http\Request;
use App\Models\AlamatCalonBaptis;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class CalonBaptisController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function alamat()
     {
         return $this->hasOne(AlamatCalonBaptis::class);
     }


    public function index(Request $request)
    {

        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' && Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }

        // Ambil query string dari request untuk pencarian
        $search = $request->input('search');
    
        // Lakukan join dengan tabel anggota
        $baptis = CalonBaptis::with('anggota')
            ->when($search, function ($query, $search) {
                return $query->whereHas('anggota', function ($q) use ($search) {
                    $q->where('namaDepanAnggota', 'LIKE', "%{$search}%")
                      ->orWhere('namaBelakangAnggota', 'LIKE', "%{$search}%");
                });
            })
            ->simplePaginate(5);


            $baptis->appends(['search' => $search]);
    
        return view('calonBaptis.index', compact('baptis'));
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' && Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }

        //
        $anggota = Anggota::whereNotIn('anggotaID', function($query) {
            $query->select('anggotaID')->from('calonBaptis');
        })->get();
        
        $pendeta = Pendeta::all();
        if ($anggota->isEmpty()) {
            return redirect()->back()->with('error', 'Belum ada data calon baptis yang tersedia.');
        }
        if ($pendeta->isEmpty() ) {
            return redirect()->back()->with('error', 'Belum ada pendeta');
        }
        return view('calonBaptis.create', compact('anggota', 'pendeta'));
       
      
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
            //    'RT' => ['required', 'regex:/^(?!000$)\d{1,3}$/']
               'RT' => 'required|regex:/^(?!000$)\d{1,3}$/',
               'RW' => 'required|regex:/^(?!000$)\d{1,3}$/',
               'kodePos' => 'required|regex:/^[0-9]{1,5}$/|max:5',
            ]);

        $lastBaptis = CalonBaptis::orderBy('baptisID', 'desc')->first();
        if ($lastBaptis) {
            // Ekstrak bagian numerik dari ibadahID
            $lastNumber = intval(substr($lastBaptis->baptisID, 2));
            
            // Tambahkan 1 ke nomor terakhir
            $newNumber = $lastNumber + 1;
            
            // Format ulang ibadahID dengan huruf 'B' di depan
            $baptisID = 'CB' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        } else {
            $baptisID = 'CB001';
        }

$baptis = new CalonBaptis();
$baptis->baptisID = $baptisID; 
$baptis->anggotaID = $request->anggotaID;
$baptis->pendetaID = $request->pendetaID;
$baptis->namaAyah = $request->namaAyah;
$baptis->namaIbu = $request->namaIbu;
$baptis->tanggalBaptis = $request->tanggalBaptis;
$baptis->save();  // Simpan data anggota

// Buat alamat baru dan simpan
$alamat = new AlamatCalonBaptis();
$alamat->baptisID = $baptisID; // Pastikan foreign key sesuai
$alamat->kelurahan = $request->kelurahan;
$alamat->kecamatan = $request->kecamatan;
$alamat->kota = $request->kota;
$alamat->provinsi = $request->provinsi;
$alamat->namaJalan = $request->namaJalan;
$alamat->RT = $request->RT;
$alamat->RW = $request->RW;
$alamat->kodePos = $request->kodePos;
$alamat->save();  // Simpan data alamat

return redirect()->route('calonBaptis')->with('success', 'calon baptis added successfully');


    }

   
    public function edit(string $id)
    {

        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' && Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }

        $baptis = CalonBaptis::where('baptisID', $id)->firstOrFail();
    
        $pendetaTerpilih = Pendeta::where('pendetaID', $baptis->pendetaID)->first();
    
        // Ambil data pendeta lainnya (semua pendeta untuk dropdown)
        $pendeta = Pendeta::all();
        
        $calonTerpilih = Anggota::where('anggotaID', $baptis->anggotaID)->first();
    

        $anggota = Anggota::whereNotIn('anggotaID', function($query) {
            $query->select('anggotaID')->from('calonBaptis');
        })->get();
        // Ambil data pendeta lainnya (semua pendeta untuk dropdown)
       

        $anggota->push($calonTerpilih);

        $alamatBaptis = $baptis->alamat;

        return view('calonBaptis.edit', compact('baptis','pendetaTerpilih', 'pendeta', 'calonTerpilih', 'anggota', 'alamatBaptis'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' && Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }

        
        $request->validate([
            //    'RT' => ['required', 'regex:/^(?!000$)\d{1,3}$/']
               'RT' => 'required|regex:/^(?!000$)\d{1,3}$/',
               'RW' => 'required|regex:/^(?!000$)\d{1,3}$/',
               'kodePos' => 'required|regex:/^[0-9]{1,5}$/|max:5',
            ]);


        $baptis = calonBaptis::findOrFail($id);
        
        $baptis->update($request->all());

        if ($baptis->alamat) {
            $baptis->alamat->update($request->only([
                'namaJalan', 'RT', 'RW', 'kodePos', 'kelurahan', 'kecamatan', 'kota', 'provinsi'
            ]));
        }

        return redirect()->route('calonBaptis')->with('success', 'Calon baptis updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' && Auth::user()->role !== 'super' ) {
            return redirect()->back();
        }

        //
        $baptis = CalonBaptis::findOrFail($id);
  
        $baptis->delete();
  
        return redirect()->route('calonBaptis')->with('success', 'calon baptis deleted successfully');

    }
}
