@extends('layouts.appAgt')
  
@section('title', 'Home Ibadah')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Ibadah</h1>
        <a href="{{ route('ibadah.create') }}" class="btn btn-primary">Add Ibadah</a>
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

      <!-- Filter berdasarkan kategori jenis ibadah -->
      <form action="{{ route('ibadah') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <select name="ibadahID" class="form-control">
                    <option value="">-- Semua Kategori Ibadah --</option>
                    @foreach($jenisIbadah as $jenis)
                        <option value="{{ $jenis->ibadahID }}" 
                            {{ request()->ibadahID == $jenis->ibadahID ? 'selected' : '' }}>
                            {{ $jenis->namaIbadah }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>Nama Ibadah</th>
                <th>Tanggal</th>
                <th>Nama Pendeta</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($ibadah->count() > 0)
                @foreach($ibadah as $rs)
                    <tr>
                        <td class="align-middle">{{ $rs->jenisIbadah->namaIbadah }}</td>
                        <td class="align-middle">{{ $rs->formatted_tanggal_ibadah }}</td>
                        <td class="align-middle">{{ $rs->pendeta->namaDepanPendeta }} {{ $rs->pendeta->namaBelakangPendeta }}</td>
                        <td class="align-middle">
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton{{ $rs->dataIbadahID }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    ⋮
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $rs->dataIbadahID }}">
                                    <li>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailModal{{ $rs->dataIbadahID }}">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('ibadah.edit', $rs->dataIbadahID) }}">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('ibadah.destroy', $rs->dataIbadahID) }}" method="POST" 
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
                    <div class="modal fade" id="detailModal{{ $rs->dataIbadahID }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $rs->dataIbadahID }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailModalLabel{{ $rs->dataIbadahID }}">Detail Ibadah</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
         
                                        <div class="mb-3 row">
                                            <label for="dataIbadahID" class="col-sm-3 col-form-label">Nama Ibadah</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="dataIbadahID" class="form-control" id="dataIbadahID" value="{{ $rs->jenisIbadah->namaIbadah }} " readonly>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3 row">
                                            <label for="pendetaID" class="col-sm-3 col-form-label">Nama Pendeta</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="pendetaID" class="form-control" id="pendetaID" value="{{ $rs->pendeta->namaDepanPendeta }} {{ $rs->pendeta->namaBelakangPendeta }}" readonly>
                                            </div>
                                        </div>
                                
                                        <div class="mb-3 row">
                                            <label for="tanggalIbadah" class="col-sm-3 col-form-label">Tanggal Ibadah</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="tanggalIbadah" class="form-control" id="tanggalIbadah" value="{{ $rs->formatted_tanggal_Ibadah }}" readonly>
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
                    <td class="text-center" colspan="5">Ibadah not found</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $ibadah->links() }}
    </div> 

    <!-- Di bagian head -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

<!-- Di bagian bawah body -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



@endsection

