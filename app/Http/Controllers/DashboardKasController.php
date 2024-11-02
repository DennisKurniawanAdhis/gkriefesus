<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kas;
use App\Models\Pengeluaran;
use App\Models\JenisIbadah;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardKasController extends Controller
{
    public function index(Request $request)
    {
        // Set tanggal default jika tidak ada filter
        $tanggalAwal = $request->input('tanggalAwal') ? 
            Carbon::parse($request->input('tanggalAwal'))->startOfDay() : null;
        $tanggalAkhir = $request->input('tanggalAkhir') ? 
            Carbon::parse($request->input('tanggalAkhir'))->endOfDay() : null;

        // Ambil semua jenis ibadah
        $jenisIbadah = JenisIbadah::all();

        // Array untuk menyimpan perhitungan kas per ibadah
        $kasPerIbadah = [];

        // Hitung kas untuk setiap jenis ibadah
        foreach ($jenisIbadah as $ibadah) {
            // Query untuk kolekte berdasarkan jenis ibadah
            $queryKolekte = Kas::where('ibadahID', $ibadah->ibadahID)
                ->where('jenisUang', 'kolekte');
            
            // Query untuk pengeluaran berdasarkan jenis ibadah
            $queryPengeluaran = Pengeluaran::where('ibadahID', $ibadah->ibadahID)
                ->where('jenisPengeluaran', 'kolekte');

            // Terapkan filter tanggal jika ada
            if ($tanggalAwal && $tanggalAkhir) {
                $queryKolekte->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);
                $queryPengeluaran->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);
            }

            // Hitung total kolekte dan pengeluaran
            $totalKolekte = $queryKolekte->sum('jumlahUang');
            $totalPengeluaran = $queryPengeluaran->sum('jumlahUang');

            // Hitung saldo akhir (kolekte - pengeluaran)
            $saldoAkhir = $totalKolekte - $totalPengeluaran;

            // Simpan data ke array
            $kasPerIbadah[$ibadah->ibadahID] = [
                'namaIbadah' => $ibadah->namaIbadah,
                'totalKolekte' => $totalKolekte,
                'totalPengeluaran' => $totalPengeluaran,
                'saldoAkhir' => $saldoAkhir
            ];
        }

        // Query untuk perpuluhan
        $queryPerpuluhan = Kas::where('jenisUang', 'perpuluhan');
        if ($tanggalAwal && $tanggalAkhir) {
            $queryPerpuluhan->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);
        }
        $totalPerpuluhan = $queryPerpuluhan->sum('jumlahUang');

        // Query untuk sumbangan
        $querySumbangan = Kas::where('jenisUang', 'sumbangan');
        if ($tanggalAwal && $tanggalAkhir) {
            $querySumbangan->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);
        }
        $totalSumbangan = $querySumbangan->sum('jumlahUang');

        // Query untuk pengeluaran kas umum
        $queryPengeluaranKas = Pengeluaran::where('jenisPengeluaran', 'kas');
        if ($tanggalAwal && $tanggalAkhir) {
            $queryPengeluaranKas->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);
        }
        $pengeluaranKas = $queryPengeluaranKas->sum('jumlahUang');

        // Hitung total kas keseluruhan
        $jumlahKasKeseluruhan = $totalPerpuluhan + $totalSumbangan;
        $totalPengeluaranKas = $jumlahKasKeseluruhan - $pengeluaranKas;

        return view('DashboardKas.index', compact(
            'kasPerIbadah',          // Array berisi data kas per ibadah
            'tanggalAwal',           // Tanggal awal filter
            'tanggalAkhir',          // Tanggal akhir filter
            'totalPerpuluhan',       // Total perpuluhan
            'totalSumbangan',        // Total sumbangan
            'pengeluaranKas',        // Total pengeluaran kas umum
            'totalPengeluaranKas'    // Saldo akhir kas umum
        ));
    }
}