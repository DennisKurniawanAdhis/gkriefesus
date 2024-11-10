@extends('layouts.appUang')
  
@section('title', 'Home Sumbangan')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Sumbangan</h1>
        <a href="{{ route('sumbangan.create') }}" class="btn btn-primary">Add Sumbangan</a>
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
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>Nama Penyumbang</th>
                <th>Tanggal Sumbangan</th>
                <th>Jumlah Uang</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($sumbangan->count() > 0)
                @foreach($sumbangan as $rs)
                    <tr>
                        <td class="align-middle">{{ $rs->namaPenyumbang }}</td>
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
                                        <a class="dropdown-item" href="{{ route('sumbangan.edit', $rs->kasID) }}">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('sumbangan.destroy', $rs->kasID) }}" method="POST" 
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
                                    <h5 class="modal-title" id="detailModalLabel{{ $rs->kasID }}">Detail Anggota</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
        
                                        <div class="mb-3 row">
                                            <label for="namaPenyumbang" class="col-sm-3 col-form-label">Nama Penyumbang</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="namaPenyumbang" class="form-control" id="namaPenyumbang" value="{{ $rs->namaPenyumbang }} " readonly>
                                            </div>
                                        </div>
                                
                                        <div class="mb-3 row">
                                            <label for="tanggal" class="col-sm-3 col-form-label">Tanggal Sumbangan </label>
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
                                        
                                        <div class="mb-3 row">
                                            <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="deskripsi" class="form-control" id="deskripsi" value="{{ $rs->deskripsi }} " readonly>
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
                    <td class="text-center" colspan="5">Sumbangan not found</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $sumbangan->links() }}
    </div> 

    <!-- Di bagian head -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Di bagian bawah body -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection