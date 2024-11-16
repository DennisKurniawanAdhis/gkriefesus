<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pendeta;
use App\Models\Pernikahan;
use Illuminate\Http\Request;
use App\Models\AlamatAnggota;
use App\Models\AlamatPernikahan;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class PernikahanController extends Controller
{

   
    
    public function alamat()
    {
        return $this->hasOne(AlamatPernikahan::class);
    }

    public function index()
    {
        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' ) {
            return redirect()->back();
        }

        $pernikahan = Pernikahan::with('alamat')->join('anggota as suami', 'pernikahan.anggotaID_suami', '=', 'suami.anggotaID')
        ->join('anggota as istri', 'pernikahan.anggotaID_istri', '=', 'istri.anggotaID')
        ->select('pernikahan.*', 'suami.namaDepanAnggota as nama_suami', 'istri.namaDepanAnggota as nama_istri')
        ->simplePaginate(5);

        return view('pernikahan.index', compact('pernikahan'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' ) {
            return redirect()->back();
        }
        //
        $pendeta = Pendeta::all();

        $pria = Anggota::where('jenisKelamin', 'pria')
        ->whereNotIn('anggotaID', function($query) {
            $query->select('anggotaID_suami')->from('pernikahan');
        })
        ->get();

    // Ambil anggota wanita yang belum terdaftar sebagai istri
    $wanita = Anggota::where('jenisKelamin', 'wanita')
        ->whereNotIn('anggotaID', function($query) {
            $query->select('anggotaID_istri')->from('pernikahan');
        })
        ->get();



        if ($pria->isEmpty() || $wanita->isEmpty()) {
            return redirect()->back()->with('error', 'Belum ada anggota pria atau wanita yang tersedia.');
        }

        if ($pendeta->isEmpty() ) {
            return redirect()->back()->with('error', 'Belum ada pendeta');
        }

        return view('pernikahan.create', compact('pendeta','pria', 'wanita' ));

    }

    /**
     * Store a newly created resource in storage.
     * 
     *
     */
    public function store(Request $request)
    {

        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' ) {
            return redirect()->back();
        }
        $lastPernikahan = Pernikahan::orderBy('pernikahanID', 'desc')->first();
        if ($lastPernikahan) {
            // Ekstrak bagian numerik dari ibadahID
            $lastNumber = intval(substr($lastPernikahan->pernikahanID, 1));
            
            // Tambahkan 1 ke nomor terakhir
            $newNumber = $lastNumber + 1;
            
            // Format ulang ibadahID dengan huruf 'B' di depan
            $pernikahanID = 'W' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        } else {
            $pernikahanID = 'W001';
        }
        //
$pernikahan = new Pernikahan();
$pernikahan->pernikahanID = $pernikahanID;  // Pastikan pernikahanID sesuai dengan input yang benar
$pernikahan->anggotaID_suami = $request->anggotaID_suami;
$pernikahan->anggotaID_istri = $request->anggotaID_istri;
$pernikahan->pendetaID = $request->pendetaID;
$pernikahan->tanggalPernikahan = $request->tanggalPernikahan;
$pernikahan->namaOrangKua = $request->namaOrangKua;
$pernikahan->noStbld = $request->noStbld;
$pernikahan->save();  // Simpan data anggota

// Buat alamat baru dan simpan
$alamat = new AlamatPernikahan();
$alamat->pernikahanID = $pernikahanID; // Pastikan foreign key sesuai
$alamat->kelurahan = $request->kelurahan;
$alamat->kecamatan = $request->kecamatan;
$alamat->kota = $request->kota;
$alamat->provinsi = $request->provinsi;
$alamat->namaJalan = $request->namaJalan;
$alamat->RT = $request->RT;
$alamat->RW = $request->RW;
$alamat->kodePos = $request->kodePos;
$alamat->save();  // Simpan data alamat

return redirect()->route('pernikahan')->with('success', 'Pernikahan added successfully');


    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    //     $pernikahan = Pernikahan::with(['suami', 'istri', 'pendeta'])->findOrFail($id);    
        
    //     $alamat = $pernikahan->alamat;

    //     return view('pernikahan.show', compact('pernikahan','alamat'));

    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' ) {
            return redirect()->back();
        }

          // Ambil data pernikahan berdasarkan pernikahanID
    // $pernikahan = Pernikahan::where('pernikahanID', $id)->firstOrFail();

    // Di controller
$pernikahan = Pernikahan::with(['suami', 'istri'])->find($id);

    // Ambil data pendeta yang telah dipilih
    $pendetaTerpilih = Pendeta::where('pendetaID', $pernikahan->pendetaID)->first();
    
    // Ambil data pendeta lainnya (semua pendeta untuk dropdown)
    $pendeta = Pendeta::all();

    // Ambil data suami yang telah dipilih
    // $suamiTerpilih = Anggota::where('jenisKelamin', 'pria')
    // ->get();

    $suamiTerpilih = Anggota::find($pernikahan->anggotaID_suami);

    // Ambil data istri yang terpilih
    $istriTerpilih = Anggota::find($pernikahan->anggotaID_istri);

    // Ambil semua pria untuk dropdown (termasuk yang sudah terpilih)
    $pria = Anggota::where('jenisKelamin', 'pria')
        ->whereNotIn('anggotaID', function($query) use ($id) {
            $query->select('anggotaID_suami')
                  ->from('pernikahan')
                  ->where('pernikahanID', '!=', $id); // Pengecualian untuk data yang sedang diedit
        })
        ->get();

    // Ambil semua wanita untuk dropdown (termasuk yang sudah terpilih)
    $wanita = Anggota::where('jenisKelamin', 'wanita')
        ->whereNotIn('anggotaID', function($query) use ($id) {
            $query->select('anggotaID_istri')
                  ->from('pernikahan')
                  ->where('pernikahanID', '!=', $id); // Pengecualian untuk data yang sedang diedit
        })
        ->get();


    // // Ambil semua pria dari tabel Anggota untuk dropdown
    // $pria = Anggota::where('jenisKelamin', 'pria')
    //     ->whereNotIn('anggotaID', function($query) {
    //         $query->select('anggotaID_suami')->from('pernikahan');
    //     })
    //     ->get();

    // // Ambil data istri yang telah dipilih
    // $istriTerpilih = Anggota::where('jenisKelamin', 'wanita')
    // ->get();

    // // Ambil semua wanita untuk dropdown
    //   $wanita = Anggota::where('jenisKelamin', 'wanita')
    //     ->whereNotIn('anggotaID', function($query) {
    //         $query->select('anggotaID_istri')->from('pernikahan');
    //     })
    //     ->get();

    $alamatPernikahan = $pernikahan->alamat; 

    return view('pernikahan.edit', compact('pernikahan', 'pendetaTerpilih', 'pendeta', 'suamiTerpilih', 'pria', 'istriTerpilih', 'wanita','alamatPernikahan'));


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
        $pernikahan = Pernikahan::findOrFail($id);
        
        $pernikahan->update($request->all());

        if ($pernikahan->alamat) {
            $pernikahan->alamat->update($request->only([
                'namaJalan', 'RT', 'RW', 'kodePos', 'kelurahan', 'kecamatan', 'kota', 'provinsi'
            ]));
        }

        return redirect()->route('pernikahan')->with('success', 'Pernikahan updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        if (!Auth::check() || Auth::user()->role !== 'keanggotaan' ) {
            return redirect()->back();
        }
        $pernikahan = Pernikahan::findOrFail($id);
  
        $pernikahan->delete();
  
        return redirect()->route('pernikahan')->with('success', 'Pernikahan deleted successfully');

    }
}
