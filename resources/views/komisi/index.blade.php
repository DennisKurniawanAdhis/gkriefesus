@extends('layouts.appAgt')
  
@section('title', 'Home Komisi')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Komisi</h1>
        <a href="{{ route('komisi.create') }}" class="btn btn-primary">Add Komisi</a>
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
                <th>Nama Komisi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>+
            @if($komisi->count() > 0)
                @foreach($komisi as $rs)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $rs->namaKomisi }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('komisi.show', $rs->komisiID) }}" type="button" class="btn btn-secondary">Detail</a>
                                <a href="{{ route('komisi.edit', $rs->komisiID)}}" type="button" class="btn btn-warning">Edit</a>
                                <form action="{{ route('komisi.destroy', $rs->komisiID) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
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
                    <td class="text-center" colspan="5">Komisi not found</td>
                </tr>
            @endif
        </tbody>
    </table> --}}
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>Nama Komisi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($dataKomisi->count() > 0)
                @foreach($dataKomisi as $rs)
                    <tr>
                        <td class="align-middle">{{ $rs['komisi']->namaKomisi }}</td>
                        <td class="align-middle">
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton{{ $rs['komisi']->komisiID }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    ⋮
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $rs['komisi']->komisiID }}">
                                    <li>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailModal{{ $rs['komisi']->komisiID }}">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('komisi.edit', $rs['komisi']->komisiID)}}">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('komisi.destroy', $rs['komisi']->komisiID) }}" method="POST" 
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
                    <div class="modal fade" id="detailModal{{ $rs['komisi']->komisiID }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $rs['komisi']->komisiID }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailModalLabel{{ $rs['komisi']->komisiID }}">Detail Komisi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">

                                        <div class="mb-3 row">
                                          <label for="komisiID" class="col-sm-3 col-form-label">ID Komisi</label>
                                          <div class="col-sm-9">
                                              <input type="text" name="komisiID" class="form-control" id="komisiID" value="{{ $rs['komisi']->komisiID ?? 'Tidak ada'}} " readonly>
                                          </div>
                                      </div>
                                       
                                      <div class="mb-3 row">
                                          <label for="namaKomisi" class="col-sm-3 col-form-label">Nama Komisi</label>
                                          <div class="col-sm-9">
                                              <input type="text" name="namaKomisi" class="form-control" id="namaKomisi" value="{{ $rs['komisi']->namaKomisi ?? 'Tidak ada'}} " readonly>
                                          </div>
                                      </div>
                                      
                                      <div class="mb-3 row">
                                          <label for="ketua" class="col-sm-3 col-form-label">Ketua</label>
                                          <div class="col-sm-9">
                                              <input type="text" name="ketua" class="form-control" id="ketua" value="{{ $rs['ketua']->namaDepanAnggota ?? 'Tidak'}} {{ $rs['ketua']->namaBelakangAnggota ?? 'ada'}}" readonly>
                                          </div>
                                      </div>
                              
                                      <div class="mb-3 row">
                                        <label for="wakil ketua" class="col-sm-3 col-form-label">Wakil Ketua</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="wakil ketua" class="form-control" id="wakil ketua" 
                                                   value="{{ $rs['wakil']->namaDepanAnggota ?? 'Tidak' }} {{ $rs['wakil']->namaBelakangAnggota ?? 'ada' }}" readonly>
                                        </div>
                                    </div>
                                    
                              
                                      <div class="mb-3 row">
                                          <label for="bendahara" class="col-sm-3 col-form-label">Bendahara</label>
                                          <div class="col-sm-9">
                                              <input type="text" name="bendahara" class="form-control" id="bendahara" value="{{ $rs['bendahara']->namaDepanAnggota ?? 'Tidak' }} {{ $rs['bendahara']->namaBelakangAnggota ?? 'ada'}}" readonly>
                                          </div>
                                      </div>
                              
                                      <div class="mb-3 row">
                                          <label for="sekretaris" class="col-sm-3 col-form-label">Sekretaris</label>
                                          <div class="col-sm-9">
                                              <input type="text" name="sekretaris" class="form-control" id="sekretaris" value="{{ $rs['sekretaris']->namaDepanAnggota ?? 'Tidak' }} {{ $rs['sekretaris']->namaBelakangAnggota ?? 'ada'}}" readonly>
                                          </div>
                                      </div>
                              
                                      <div class="mb-3 row">
                                          <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
                                          <div class="col-sm-9">
                                              <input type="text" name="deskripsi" class="form-control" id="deskripsi" value="{{ $rs['komisi']->deskripsi }} " readonly>
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
                    <td class="text-center" colspan="5">Komisi not found</td>
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