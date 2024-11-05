@extends('layouts.appAgt')
  
@section('title', 'Home Anggota')
  
@section('contents')



    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Anggota</h1>
        <a href="{{ route('anggota.create') }}" class="btn btn-primary">Add Anggota</a>
    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    <form action="{{ route('anggota') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari Nama Anggota" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>ID Anggota</th>
                <th>Nama anggota</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($anggota->count() > 0)
                @foreach($anggota as $rs)
                <tr>
                    <td class="align-middle">{{ $rs->anggotaID }}</td>
                    <td class="align-middle">{{ $rs->namaDepanAnggota }} {{ $rs->namaBelakangAnggota }}</td>
                    <td class="align-middle">
                        <div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton{{ $rs->anggotaID }}" data-bs-toggle="dropdown" aria-expanded="false">
                                ⋮
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $rs->anggotaID }}">
                                <li>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailModal{{ $rs->anggotaID }}">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('anggota.edit', $rs->anggotaID)}}">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('anggota.destroy', $rs->anggotaID) }}" method="POST" 
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

                <!-- Modal for each anggota -->
                <div class="modal fade" id="detailModal{{ $rs->anggotaID }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $rs->anggotaID }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailModalLabel{{ $rs->anggotaID }}">Detail Anggota</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">ID</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $rs->anggotaID }}" readonly>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Nama</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $rs->namaDepanAnggota }} {{ $rs->namaBelakangAnggota }}" readonly>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Tempat / tanggal lahir</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $rs->tempatLahir }}, {{ $rs->tanggalLahir }}" readonly>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Alamat</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" rows="3" readonly>{{ $rs->alamat->namaJalan }}, RT/RW {{ $rs->alamat->RT }}/{{ $rs->alamat->RW }}, Kel. {{ $rs->alamat->kelurahan }}, Kec. {{ $rs->alamat->kecamatan }}, {{ $rs->alamat->kota }}, {{ $rs->alamat->provinsi }}, {{ $rs->alamat->kodePos }}</textarea>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Nomor Telepon</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $rs->noTelp }}" readonly>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $rs->jenisKelamin }}" readonly>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Status Kawin</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $rs->statusKawin }}" readonly>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Pekerjaan</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $rs->pekerjaan }}" readonly>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Jabatan</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" 
                                                   value="{{ isset($rs->komisi->namaKomisi) ? 'Komisi ' . $rs->komisi->namaKomisi : '' }} ({{ $rs->jabatan ?? 'Tidak ada' }})" readonly>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Keahlian</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" 
                                                value="{{ $rs->keahlian->pluck('namaKeahlian')->implode(', ') ?: 'Tidak ada' }}" readonly>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Ibadah</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" 
                                                value="{{ $rs->jenisIbadah->pluck('namaIbadah')->implode(', ') ?: 'Tidak ada' }}" readonly>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">NIK</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $rs->NIK }}" readonly>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">No KK</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $rs->noKK }}" readonly>
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
        {{ $anggota->links() }}
    </div> 

    <!-- CSS and JS includes -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection