<?php

namespace App\Http\Controllers;

use App\Models\Ibadah;
use App\Models\Pendeta;
use App\Models\Pernikahan;
use App\Models\CalonBaptis;
use App\Models\JenisIbadah;
use Illuminate\Http\Request;

class DashboardPendetaController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua pendeta untuk dropdown
        $pendeta = Pendeta::all();

        // Ambil pendeta yang sedang dipilih
        $pendetaDipilih = $request->pendetaID ? Pendeta::find($request->pendetaID) : null;

        // Ambil tanggal awal dan akhir dari request
        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        // Mengambil Jenis Ibadah dan menghitung ibadah berdasarkan pendeta yang dipilih dan rentang tanggal
        $jenisIbadah = JenisIbadah::withCount(['ibadah' => function ($query) use ($pendetaDipilih, $tanggalAwal, $tanggalAkhir) {
            if ($pendetaDipilih) {
                $query->where('pendetaID', $pendetaDipilih->pendetaID);
                if ($tanggalAwal && $tanggalAkhir) {
                    $query->whereBetween('tanggalIbadah', [$tanggalAwal, $tanggalAkhir]);
                }
            }
        }])->get();

        // Menghitung jumlah pernikahan dan baptis berdasarkan pendeta yang dipilih dan rentang tanggal
        $jumlahPernikahan = $pendetaDipilih ? Pernikahan::where('pendetaID', $pendetaDipilih->pendetaID)
            ->when($tanggalAwal && $tanggalAkhir, function ($query) use ($tanggalAwal, $tanggalAkhir) {
                return $query->whereBetween('tanggalPernikahan', [$tanggalAwal, $tanggalAkhir]);
            })
            ->count() : 0;

        $jumlahBaptis = $pendetaDipilih ? CalonBaptis::where('pendetaID', $pendetaDipilih->pendetaID)
            ->when($tanggalAwal && $tanggalAkhir, function ($query) use ($tanggalAwal, $tanggalAkhir) {
                return $query->whereBetween('tanggalBaptis', [$tanggalAwal, $tanggalAkhir]);
            })
            ->count() : 0;

        // Set default value if no pendeta is selected
        if (!$pendetaDipilih) {
            $jumlahPernikahan = 0;
            $jumlahBaptis = 0;
            foreach ($jenisIbadah as $ji) {
                $ji->ibadah_count = 0; // Set count to 0 for all jenis ibadah if no pendeta is selected
            }
        }

        return view('DashboardPendeta.index', compact('pendeta', 'jenisIbadah', 'jumlahPernikahan', 'jumlahBaptis'));
    }
}

