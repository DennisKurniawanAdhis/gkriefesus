@extends('layouts.appUang')

@section('title', 'Dashboard Kas')

@section('contents')
<div class="container mt-5">
    <!-- Filter Section -->
    <div class="mb-4">
        <h5>Filter Berdasarkan Tanggal</h5>
        <form id="filterForm" method="GET" action="{{ route('DashboardKas.index') }}">
            <div class="row">
                <div class="col-md-5">
                    <label for="tanggalAwal">Tanggal Awal</label>
                    <input type="date" class="form-control" id="tanggalAwal" name="tanggalAwal" 
                           value="{{ request('tanggalAwal') }}">
                </div>
                <div class="col-md-5">
                    <label for="tanggalAkhir">Tanggal Akhir</label>
                    <input type="date" class="form-control" id="tanggalAkhir" name="tanggalAkhir" 
                           value="{{ request('tanggalAkhir') }}">
                </div>
                <div class="col-md-2">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn btn-primary btn-block">Filter</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Kas Ibadah Section -->
    <h5>Total Kas per Ibadah</h5>
    @foreach ($jumlahKolekteIbadah as $kolekte)
        @php
            $namaIbadah = $ibadah->firstWhere('ibadahID', $kolekte->ibadahID)->namaIbadah ?? 'Tidak Diketahui';
            $totalKolekte = $kolekte->totalKolekte ?? 0;
            $totalPengeluaran = $pengeluaranArray[$kolekte->ibadahID] ?? 0;
            $kasSetelahPengeluaran = $totalKolekte - $totalPengeluaran;
        @endphp
        <div class="mb-3 row">
            <label for="jumlahUang{{ $kolekte->ibadahID }}" class="col-sm-3 col-form-label">Kas {{ $namaIbadah }}</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <span class="input-group-text bg-white">Rp.</span>
                    <input type="text" class="form-control" value="{{ number_format($kasSetelahPengeluaran, 0, '', '.') }}" readonly>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Kas Umum Section -->
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Jumlah Kas (Perpuluhan dan Sumbangan)</label>
        <div class="col-sm-9">
            <div class="input-group">
                <span class="input-group-text bg-white">Rp.</span>
                <input type="text" class="form-control" value="{{ number_format($totalPengeluaranKas, 0, '', '.') }}" readonly>
            </div>
        </div>
    </div>

    <!-- Rincian Keuangan -->
    <div class="mt-5">
        <h5>Rincian Keuangan</h5>
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Jenis Pemasukan/Pengeluaran</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ibadah as $item)
                    @php
                        $kolekteIbadah = $jumlahKolekteIbadah->firstWhere('ibadahID', $item->ibadahID);
                        $totalKolekte = $kolekteIbadah ? $kolekteIbadah->totalKolekte : 0;
                    @endphp
                    <tr>
                        <td>Kolekte {{ $item->namaIbadah }}</td>
                        <td>Rp. {{ number_format($totalKolekte, 0, '', '.') }}</td>
                    </tr>
                @endforeach

                <tr>
                    <td>Perpuluhan</td>
                    <td>Rp. {{ number_format($totalPerpuluhan, 0, '', '.') }}</td>
                </tr>
                <tr>
                    <td>Sumbangan</td>
                    <td>Rp. {{ number_format($totalSumbangan, 0, '', '.') }}</td>
                </tr>
                <tr>
                    <td>Pengeluaran</td>
                    <td>Rp. {{ number_format($pengeluaranKas, 0, '', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Detail Pengeluaran -->
   
</div>
@endsection