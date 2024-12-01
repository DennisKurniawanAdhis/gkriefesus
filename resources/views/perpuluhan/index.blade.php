@extends('layouts.appUang')

@section('title', 'Home Perpuluhan')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Perpuluhan</h1>
        <a href="{{ route('perpuluhan.create') }}" class="btn btn-primary">Add Perpuluhan</a>
    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    @if(Session::has('warning'))
    <div class="alert alert-warning" role="alert">
        {{ Session::get('warning') }}
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger" role="alert">
        {{ Session::get('error') }}
    </div>
@endif

<form method="GET" action="{{ route('perpuluhan') }}" class="mb-3">
    <div class="row">
        <div class="col-md-6">
            <label for="anggotaID" class="form-label">Filter Nama Anggota</label>
            <select name="anggotaID" id="anggotaID" class="form-control">
                <option value="">-- Pilih Anggota --</option>
                @foreach($daftarAnggota as $id => $nama)
                    <option value="{{ $id }}" {{ request('anggotaID') == $id ? 'selected' : '' }}>
                        {{ $nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </div>
</form>

    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>Nama Anggota</th>
                <th>Tanggal Perpuluhan</th>
                <th>Jumlah Uang</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($perpuluhan->count() > 0)
                @foreach($perpuluhan as $rs)
                    <tr>
                        <td class="align-middle">{{ $rs->anggota->namaDepanAnggota }} {{ $rs->anggota->namaBelakangAnggota }}</td>
                        <td class="align-middle">{{ $rs->formatted_tanggal }}</td>
                        <td class="align-middle">Rp. {{ number_format($rs->jumlahUang, 0, '', '.') }}</td>
                        <td class="align-middle">
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton{{ $rs->kasID }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    ⋮
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $rs->kasID }}">
                                    <li>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailModal{{ $rs->kasID }}">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('perpuluhan.edit', $rs->kasID) }}">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('perpuluhan.destroy', $rs->kasID) }}" method="POST" 
                                              onsubmit="return confirm('Delete?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <div class="modal fade" id="detailModal{{ $rs->kasID }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $rs->kasID }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailModalLabel{{ $rs->kasID }}">Detail Perpuluhan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
        
                                        <div class="mb-3 row">
                                            <label for="anggotaID" class="col-sm-3 col-form-label">Nama Anggota</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="anggotaID" class="form-control" id="anggotaID" value="{{ $rs->anggota->namaDepanAnggota }} {{ $rs->anggota->namaBelakangAnggota }}" readonly>
                                            </div>
                                        </div>
                                
                                        <div class="mb-3 row">
                                            <label for="tanggal" class="col-sm-3 col-form-label">Tanggal Perpuluhan </label>
                                            <div class="col-sm-9">
                                                <input type="text" name="tanggal" class="form-control" id="tanggal" value="{{ $rs->formatted_tanggal}}" readonly>
                                            </div>
                                        </div>
                                
                                        <div class="mb-3 row">
                                            <label for="jumlahUang" class="col-sm-3 col-form-label">Jumlah Uang</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <span class="input-group-text bg-white">Rp.</span> <!-- Menambahkan kelas bg-white -->
                                                    <input type="text" name="jumlahUang" class="form-control" id="jumlahUang" value="{{ number_format($rs->jumlahUang, 0, '', '.') }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                
                                    </div> 
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="5">Perpuluhan not found</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{$perpuluhan->appends(request()->query())->links() }}
    </div> 

<!-- Di bagian head -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

<!-- Di bagian bawah body -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection