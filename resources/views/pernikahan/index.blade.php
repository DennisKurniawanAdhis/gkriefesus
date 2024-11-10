@extends('layouts.appAgt')
  
@section('title', 'Home Pernikahan')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Pasangan Pernikahan</h1>
        <a href="{{ route('pernikahan.create') }}" class="btn btn-primary">Add Pernikahan</a>
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
                <th>ID Pernikahan</th>
                <th>Nama Pasangan Pria</th>
                <th>Nama Pasangan Wanita</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($pernikahan->count() > 0)
                @foreach($pernikahan as $rs)
                    <tr>
                        <td class="align-middle">{{ $rs->pernikahanID }}</td>
                        <td class="align-middle">{{ $rs->nama_suami }}</td>
                        <td class="align-middle">{{ $rs->nama_istri }}</td>
                        <td class="align-middle">
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton{{ $rs->pernikahanID }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    ⋮
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $rs->pernikahanID }}">
                                    <li>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailModal{{ $rs->pernikahanID }}">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('pernikahan.edit', $rs->pernikahanID)}}">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('pernikahan.destroy', $rs->pernikahanID) }}" method="POST" 
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
                    <div class="modal fade" id="detailModal{{ $rs->pernikahanID }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $rs->pernikahanID }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailModalLabel{{ $rs->pernikahanID }}">Detail Pernikahan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="mb-3 row">
                                            <label for="pernikahanID" class="col-sm-3 col-form-label">ID</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="pernikahanID" class="form-control" id="pernikahanID" value="{{ $rs->pernikahanID }}" readonly>
                                            </div>
                                        </div>
                                
                                        <div class="mb-3 row">
                                            <label for="anggotaID_suami" class="col-sm-3 col-form-label">Nama Pasangan Pria</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="anggotaID_suami" class="form-control" id="anggotaID_suami" value="{{ $rs->suami->namaDepanAnggota }} {{ $rs->suami->namaBelakangAnggota }}" readonly>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3 row">
                                            <label for="anggotaID_istri" class="col-sm-3 col-form-label">Nama Pasangan Wanita</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="anggotaID_istri" class="form-control" id="anggotaID_istri" value="{{ $rs->istri->namaDepanAnggota }} {{ $rs->istri->namaBelakangAnggota }}" readonly>
                                            </div>
                                        </div>
                                
                                        <div class="mb-3 row">
                                            <label for="pendetaID" class="col-sm-3 col-form-label">Nama Pendeta</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="pendetaID" class="form-control" id="pendetaID" value="{{ $rs->pendeta->namaDepanPendeta }} {{ $rs->pendeta->namaBelakangPendeta }}" readonly>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3 row">
                                            <label for="tanggalPernikahan" class="col-sm-3 col-form-label">Tanggal Pernikahan</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="tanggalPernikahan" class="form-control" id="tanggalPernikahan" value="{{ $rs->formatted_tanggal_pernikahan }}" readonly>
                                            </div>
                                        </div>
                                
                                        <div class="mb-3 row">
                                            <label for="namaOrangKua" class="col-sm-3 col-form-label">Nama Pihak Kua</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="namaOrangKua" class="form-control" id="namaOrangKua" value="{{ $rs->namaOrangKua }}" readonly>
                                            </div>
                                        </div>
                                
                                        <div class="mb-3 row">
                                            <label for="noStbld" class="col-sm-3 col-form-label">Nomor Stbld</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="noStbld" class="form-control" id="noStbld" value="{{ $rs->noStbld }}" readonly>
                                            </div>
                                        </div>
                                
                                        <div class="mb-3 row">
                                            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                            <div class="col-sm-9">
                                                <textarea name="alamat" class="form-control" id="alamat" rows="3" readonly>{{ $rs->alamat->namaJalan }}, RT/RW {{ $rs->alamat->RT }}/{{ $rs->alamat->RW }}, Kel. {{ $rs->alamat->kelurahan }}, Kec. {{ $rs->alamat->kecamatan }}, {{ $rs->alamat->kota }}, {{ $rs->alamat->provinsi }}, {{ $rs->alamat->kodePos }}</textarea>
                                
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
                    <td class="text-center" colspan="5">Anggota not found</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $pernikahan->links() }}
    </div> 


<!-- Di bagian head -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

<!-- Di bagian bawah body -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


@endsection