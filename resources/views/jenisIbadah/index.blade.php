@extends('layouts.appAgt')
  
@section('title', 'Home Kategori Ibadah')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Kategori Ibadah</h1>
        <a href="{{ route('jenisIbadah.create') }}" class="btn btn-primary">Add Kategori Ibadah</a>
    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    {{-- <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Nama Ibadah</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>+
            @if($jenisIbadah->count() > 0)
                @foreach($jenisIbadah as $rs)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $rs->namaIbadah }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('jenisIbadah.show', $rs->ibadahID) }}" type="button" class="btn btn-secondary">Detail</a>
                                <a href="{{ route('jenisIbadah.edit', $rs->ibadahID)}}" type="button" class="btn btn-warning">Edit</a>
                                <form action="{{ route('jenisIbadah.destroy', $rs->ibadahID) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger m-0">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="5">Kategori not found</td>
                </tr>
            @endif
        </tbody>
    </table> --}}

    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>Nama Ibadah</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($jenisIbadah->count() > 0)
                @foreach($jenisIbadah as $rs)
                    <tr>
                        <td class="align-middle">{{ $rs->namaIbadah }}</td>
                        <td class="align-middle">
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton{{ $rs->ibadahID }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    ⋮
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $rs->ibadahID }}">
                                    <li>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailModal{{ $rs->ibadahID }}">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('jenisIbadah.edit', $rs->ibadahID)}}">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('jenisIbadah.destroy', $rs->ibadahID) }}" method="POST" 
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
                    <div class="modal fade" id="detailModal{{ $rs->ibadahID }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $rs->ibadahID }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailModalLabel{{ $rs->ibadahID }}">Detail Jenis Ibadah</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
    
                                        <!-- ID -->
                                        <div class="mb-3">
                                          <label for="ibadahID" class="form-label">ID</label>
                                          <input type="text" name="ibadahID" class="form-control" id="ibadahID" placeholder="ID Ibadah" value="{{ $rs->ibadahID }}" readonly>
                                      </div>
                                  
                                      <div class="mb-3">
                                          <label for="namaIbadah" class="form-label">Nama Ibadah</label>
                                          <input type="text" name="namaIbadah" class="form-control" id="namaIbadah" placeholder="Nama Ibadah" value="{{ $rs->namaIbadah }}" readonly>
                                      </div>
                                  
                                      <div class="mb-3">
                                          <label for="namaIbadah" class="form-label">Nama Ibadah</label>
                                          <input type="text" name="namaIbadah" class="form-control" id="namaIbadah" placeholder="Nama Ibadah" value="{{ $rs->hari }}" readonly>
                                      </div>
                                  
                                      <div class="mb-3">
                                          <label for="waktu" class="form-label">Waktu</label>
                                          <input type="time" name="waktu" class="form-control w-25" id="waktu" placeholder="HH:MM" value="{{ $rs->waktu }}" readonly>
                                      </div>
                                      
                                      
                                  
                                      <div class="mb-3">
                                          <label for="lokasi" class="form-label">Lokasi</label>
                                          <input type="text" name="lokasi" class="form-control" id="lokasi" placeholder="Lokasi" value="{{ $rs->lokasi }}" readonly>
                                      </div>
                                  
                                      <div class="mb-3">
                                          <label for="deskripsi" class="form-label">Deskripsi</label>
                                          <input type="text" name="deskripsi" class="form-control" id="deskripsi" placeholder="Deskripsi" value="{{ $rs->deskripsi }}" readonly>
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
                    <td class="text-center" colspan="5">Kategori not found</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $jenisIbadah->links() }}
    </div> 

<!-- Di bagian head -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

<!-- Di bagian bawah body -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


@endsection