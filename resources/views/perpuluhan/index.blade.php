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
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>No</th>
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
                        <td class="align-middle">{{ $loop->iteration }}</td>
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

<!-- Di bagian head -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

<!-- Di bagian bawah body -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection