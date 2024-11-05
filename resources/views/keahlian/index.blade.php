@extends('layouts.appAgt')
  
@section('title', 'Home Keahlian')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Keahlian</h1>
        <a href="{{ route('keahlian.create') }}" class="btn btn-primary">Add Keahlian</a>
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
                <th>Nama Keahlian</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($keahlian->count() > 0)
                @foreach($keahlian as $rs)
                    <tr>
                        <td class="align-middle">{{ $rs->namaKeahlian }}</td>
                        <td class="align-middle">
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton{{ $rs->keahlianID }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    ⋮
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $rs->keahlianID }}">
                                    <li>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailModal{{ $rs->keahlianID }}">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('keahlian.edit', $rs->keahlianID) }}">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('keahlian.destroy', $rs->keahlianID) }}" method="POST" 
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
                    <div class="modal fade" id="detailModal{{ $rs->keahlianID }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $rs->keahlianID }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailModalLabel{{ $rs->keahlianID }}">Detail Keahlian</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="mb-3 row">
                                            <label for="keahlianID" class="col-sm-3 col-form-label">ID</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="keahlianID" class="form-control" id="keahlianID" value="{{ $rs->keahlianID }}" readonly>
                                            </div>
                                        </div>
                                
                                        <div class="mb-3 row">
                                            <label for="namaKeahlian" class="col-sm-3 col-form-label">Nama Keahlian</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="namaKeahlian" class="form-control" id="namaKeahlian" value="{{ $rs->namaKeahlian }}" readonly>
                                            </div>
                                        </div>
                                
                                        <div class="mb-3 row">
                                            <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="deskripsi" class="form-control" id="deskripsi" value="{{ $rs->deskripsi }}" readonly>
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
                    <td class="text-center" colspan="5">Calon Baptis not found</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $keahlian->links() }}
    </div> 

    <!-- Di bagian head -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

<!-- Di bagian bawah body -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



@endsection

