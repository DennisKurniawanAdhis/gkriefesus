@extends('layouts.appAgt')

@section('title', 'Home Calon Baptis')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Baptis</h1>
        <a href="{{ route('calonBaptis.create') }}" class="btn btn-primary">Add Calon Baptis</a>
    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    <form action="{{ route('calonBaptis') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari Nama Calon Baptis" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    {{-- <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>ID Baptis</th>
                <th>Nama Calon Baptis</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($baptis->count() > 0)
                @foreach($baptis as $rs)
                    <tr>
                        <td class="align-middle">{{ $rs->baptisID }}</td>
                        <td class="align-middle">{{ $rs->anggota->namaDepanAnggota }} {{ $rs->anggota->namaBelakangAnggota }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('calonBaptis.show', $rs->baptisID) }}" type="button" class="btn btn-secondary">Detail</a>
                                <a href="{{ route('calonBaptis.edit', $rs->baptisID)}}" type="button" class="btn btn-warning">Edit</a>
                                <form action="{{ route('calonBaptis.destroy', $rs->baptisID) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="4">Calon Baptis not found</td>
                </tr>
            @endif
        </tbody>
    </table> --}}

    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>ID Baptis</th>
                <th>Nama Calon Baptis</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($baptis->count() > 0)
            @foreach($baptis as $rs)
            <tr>
                <td class="align-middle">{{ $rs->baptisID }}</td>
                <td class="align-middle">{{ $rs->anggota->namaDepanAnggota }} {{ $rs->anggota->namaBelakangAnggota }}</td>
                <td class="align-middle">
                    <div class="dropdown">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton{{ $rs->baptisID }}" data-bs-toggle="dropdown" aria-expanded="false">
                            ⋮
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $rs->baptisID }}">
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailModal{{ $rs->baptisID }}">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('calonBaptis.edit', $rs->baptisID)}}">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('calonBaptis.destroy', $rs->baptisID) }}" method="POST" onsubmit="return confirm('Delete?')">
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
        
            <!-- Modal Detail -->
            <div class="modal fade" id="detailModal{{ $rs->baptisID }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $rs->baptisID }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailModalLabel{{ $rs->baptisID }}">Detail Calon Baptis</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="mb-3 row">
                                    <label for="baptisID" class="col-sm-3 col-form-label">ID</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="baptisID" class="form-control" id="baptisID" value="{{ $rs->baptisID }}" readonly>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="anggotaID" class="col-sm-3 col-form-label">Nama Anggota</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="anggotaID" class="form-control" id="anggotaID" value="{{ $rs->anggota->namaDepanAnggota }} {{ $rs->anggota->namaBelakangAnggota }}" readonly>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="pendetaID" class="col-sm-3 col-form-label">Nama Pendeta</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="pendetaID" class="form-control" id="pendetaID" value="{{ $rs->pendeta->namaDepanPendeta }} {{ $rs->pendeta->namaBelakangPendeta }}" readonly>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="namaAyah" class="col-sm-3 col-form-label">Nama Ayah</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="namaAyah" class="form-control" id="namaAyah" value="{{ $rs->namaAyah }}" readonly>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="namaIbu" class="col-sm-3 col-form-label">Nama Ibu</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="namaIbu" class="form-control" id="namaIbu" value="{{ $rs->namaIbu }}" readonly>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="tanggalBaptis" class="col-sm-3 col-form-label">Tanggal Baptis</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="tanggalBaptis" class="form-control" id="tanggalBaptis" value="{{ $rs->formatted_tanggal_baptis }}" readonly>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                    <div class="col-sm-9">
                                        <textarea name="alamat" class="form-control" id="alamat" rows="3" readonly>{{ $rs->anggota->alamat->namaJalan }}, RT/RW {{ $rs->anggota->alamat->RT }}/{{ $rs->anggota->alamat->RW }}, Kel. {{ $rs->anggota->alamat->kelurahan }}, Kec. {{ $rs->anggota->alamat->kecamatan }}, {{ $rs->anggota->alamat->kota }}, {{ $rs->anggota->alamat->provinsi }}, {{ $rs->anggota->alamat->kodePos }}</textarea>
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
                    <td class="text-center" colspan="4">Calon Baptis not found</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $baptis->links() }}
    </div> 

    <!-- Di bagian head -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

<!-- Di bagian bawah body -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


@endsection
