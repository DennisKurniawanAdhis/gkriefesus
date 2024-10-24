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
        $ibadah = JenisIbadah::all();

        // Query untuk kolekte berdasarkan ibadah
        $queryKolekte = Kas::select('ibadahID', DB::raw('SUM(jumlahUang) as totalKolekte'))
            ->where('jenisUang', 'kolekte')
            ->groupBy('ibadahID');

        if ($tanggalAwal && $tanggalAkhir) {
            $queryKolekte->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);
        }
        $jumlahKolekteIbadah = $queryKolekte->get();

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

        // Query untuk pengeluaran kolekte per ibadah
        $queryPengeluaranKolekte = DB::table('pengeluaran')
            ->join('jenisIbadah', 'pengeluaran.ibadahID', '=', 'jenisIbadah.ibadahID')
            ->select('pengeluaran.ibadahID', DB::raw('SUM(pengeluaran.jumlahUang) as totalPengeluaran'))
            ->where('pengeluaran.jenisPengeluaran', 'kolekte')
            ->groupBy('pengeluaran.ibadahID');

        if ($tanggalAwal && $tanggalAkhir) {
            $queryPengeluaranKolekte->whereBetween('pengeluaran.tanggal', [$tanggalAwal, $tanggalAkhir]);
        }
        
        $pengeluaranKolekteTiapIbadah = $queryPengeluaranKolekte->get();

        // Convert pengeluaran ke array untuk kemudahan akses
        $pengeluaranArray = [];
        foreach ($pengeluaranKolekteTiapIbadah as $pengeluaran) {
            $pengeluaranArray[$pengeluaran->ibadahID] = $pengeluaran->totalPengeluaran;
        }

        // Query untuk total pengeluaran kas (non-kolekte)
        $queryPengeluaranKas = Pengeluaran::where('jenisPengeluaran', 'kas');
        if ($tanggalAwal && $tanggalAkhir) {
            $queryPengeluaranKas->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);
        }
        $pengeluaranKas = $queryPengeluaranKas->sum('jumlahUang');

        // Query untuk detail semua pengeluaran
        $queryDetailPengeluaran = Pengeluaran::query()
            ->leftJoin('jenisIbadah', 'pengeluaran.ibadahID', '=', 'jenisIbadah.ibadahID')
            ->select(
                'pengeluaran.*',
                'jenisIbadah.namaIbadah'
            )
            ->orderBy('tanggal', 'desc');

        if ($tanggalAwal && $tanggalAkhir) {
            $queryDetailPengeluaran->whereBetween('pengeluaran.tanggal', [$tanggalAwal, $tanggalAkhir]);
        }
        
        $detailPengeluaran = $queryDetailPengeluaran->get();

        // Hitung total kas keseluruhan (perpuluhan + sumbangan)
        $queryKasKeseluruhan = Kas::whereIn('jenisUang', ['perpuluhan', 'sumbangan']);
        if ($tanggalAwal && $tanggalAkhir) {
            $queryKasKeseluruhan->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);
        }
        $jumlahKasKeseluruhan = $queryKasKeseluruhan->sum('jumlahUang');

        $totalPengeluaranKas = $jumlahKasKeseluruhan - $pengeluaranKas;

        return view('DashboardKas.index', compact(
            'jumlahKolekteIbadah',
            'ibadah',
            'totalPerpuluhan',
            'totalSumbangan',
            'tanggalAwal',
            'tanggalAkhir',
            'jumlahKasKeseluruhan',
            'pengeluaranKas',
            'totalPengeluaranKas',
            'pengeluaranKolekteTiapIbadah',
            'pengeluaranArray',
            'detailPengeluaran'
        ));
    }
}