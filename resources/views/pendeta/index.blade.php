@extends('layouts.appAgt')
  
@section('title', 'Home Pendeta')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Pendeta</h1>
        <a href="{{ route('pendeta.create') }}" class="btn btn-primary">Add Pendeta</a>
    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    <form action="{{ route('pendeta') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari Nama Pendeta" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

   

    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>ID Pendeta</th>
                <th>Nama pendeta</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($pendeta->count() > 0)
                @foreach($pendeta as $rs)
                    <tr>
                        <td class="align-middle">{{ $rs->pendetaID }}</td>
                        <td class="align-middle">{{ $rs->namaDepanPendeta }} {{ $rs->namaBelakangPendeta }}</td>
                        <td class="align-middle">
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton{{ $rs->pendetaID }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    ⋮
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $rs->pendetaID }}">
                                    <li>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailModal{{ $rs->pendetaID }}">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('pendeta.edit', $rs->pendetaID)}}">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('pendeta.destroy', $rs->pendetaID) }}" method="POST" 
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
                    <div class="modal fade" id="detailModal{{ $rs->pendetaID }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $rs->pendetaID }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailModalLabel{{ $rs->pendetaID }}">Detail Pendeta</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="mb-3 row">
                                            <label for="pendetaID" class="col-sm-3 col-form-label">ID</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="pendetaID" class="form-control" id="pendetaID" value="{{ $rs->pendetaID }}" readonly>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3 row">
                                            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nama" class="form-control" id="nama" value="{{ $rs->namaDepanPendeta }} {{ $rs->namaBelakangPendeta }}" readonly>
                                            </div>
                                        </div>
                                
                                        <div class="mb-3 row">
                                            <label for="tempat" class="col-sm-3 col-form-label">Tempat / tanggal lahir</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="tempat" class="form-control" id="tempat" value="{{ $rs->tempatLahir }}, {{ $rs->formatted_tanggal_lahir }}" readonly>
                                            </div>
                                        </div>
                                
                                        <div class="mb-3 row">
                                            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                            <div class="col-sm-9">
                                                <textarea name="alamat" class="form-control" id="alamat" rows="3" readonly>{{ $rs->alamat->namaJalan }}, RT/RW {{ $rs->alamat->RT }}/{{ $rs->alamat->RW }}, Kel. {{ $rs->alamat->kelurahan }}, Kec. {{ $rs->alamat->kecamatan }}, {{ $rs->alamat->kota }}, {{ $rs->alamat->provinsi }}, {{ $rs->alamat->kodePos }}
                                                </textarea>
                                            </div>
                                        </div>
                                
                                        <div class="mb-3 row">
                                            <label for="telp" class="col-sm-3 col-form-label">Nomor Telepon</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="telp" class="form-control" id="telp" value="{{ $rs->noTelp }}" readonly>
                                            </div>
                                        </div>
                                
                                        <div class="mb-3 row">
                                            <label for="jenisKelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="jenisKelamin" class="form-control" id="telp" value="{{ $rs->jenisKelamin }}" readonly>
                                            </div>
                                        </div>
                                
                                        <div class="mb-3 row">
                                            <label for="statusKawin" class="col-sm-3 col-form-label">Status Kawin</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="statusKawin" class="form-control" id="telp" value="{{ $rs->statusKawin }}" readonly>
                                            </div>
                                        </div>
                                
                                      
                                
                                        <div class="mb-3 row">
                                            <label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="pekerjaan" class="form-control" id="pekerjaan" value="{{ $rs->pekerjaan }}" readonly>
                                            </div>
                                        </div>
                                
                                
                                        <div class="mb-3 row">
                                            <label for="gelar" class="col-sm-3 col-form-label">Gelar</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="gelar" class="form-control" id="gelar" value="{{ $rs->gelar }}" readonly>
                                            </div>
                                        </div>
                                
                                        <div class="mb-3 row">
                                            <label for="nik" class="col-sm-3 col-form-label">NIK</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nik" class="form-control" id="nik" value="{{ $rs->NIK }}" readonly>
                                            </div>
                                        </div>
                                
                                        <div class="mb-3 row">
                                            <label for="kk" class="col-sm-3 col-form-label">No KK</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="kk" class="form-control" id="kk" value="{{ $rs->noKK }}" readonly>
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
                    <td class="text-center" colspan="5">Pendeta not found</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $pendeta->links() }}
    </div> 

    <!-- Di bagian head -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

<!-- Di bagian bawah body -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection