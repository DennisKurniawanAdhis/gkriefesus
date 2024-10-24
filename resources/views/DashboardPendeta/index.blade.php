@extends('layouts.appAgt')

@section('title', 'Dashboard Pendeta')

@section('contents')
<div class="container">
    <h1>Dashboard Pendeta</h1>

    <form method="GET" action="{{ route('DashboardPendeta.index') }}">
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="pendetaID">Pilih Pendeta</label>
                <select name="pendetaID" id="pendetaID" class="form-control">
                    <option value="">Pilih Pendeta</option>
                    @foreach($pendeta as $p)
                        <option value="{{ $p->pendetaID }}" {{ request('pendetaID') == $p->pendetaID ? 'selected' : '' }}>
                            {{ $p->namaDepanPendeta }} {{ $p->namaBelakangPendeta }}
                        </option>
                    @endforeach
                </select>
            </div>
    
            <div class="col-md-3">
                <label for="tanggal_awal">Tanggal Awal</label>
                <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">
            </div>
    
            <div class="col-md-3">
                <label for="tanggal_akhir">Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
            </div>
    
            <!-- Penempatan button filter di sebelah kanan setelah Tanggal Akhir -->
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>

    <h2 class="mt-5">Rincian Layanan Pendeta</h2>
    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
                <th>Jenis Layanan</th>
                <th>Jumlah Layanan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jenisIbadah as $ibadah)
            <tr>
                <td>Ibadah {{ $ibadah->namaIbadah }}</td>
                <td>{{ $ibadah->ibadah_count ?? '0' }}</td>
            </tr>
            @endforeach
            <tr>
                <td>Pernikahan</td>
                <td>{{ $jumlahPernikahan }}</td> <!-- Tampilkan jumlah pernikahan -->
            </tr>
            <tr>
                <td>Baptis</td>
                <td>{{ $jumlahBaptis }}</td> <!-- Tampilkan jumlah baptis -->
            </tr>
        </tbody>
    </table>
</div>
@endsection
