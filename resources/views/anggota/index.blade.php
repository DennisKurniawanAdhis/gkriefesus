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
                <th>#</th>
                <th>ID Anggota</th>
                <th>Nama anggota</th>
                <th>Jenis Kelamin</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>+
            @if($anggota->count() > 0)
                @foreach($anggota as $rs)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $rs->anggotaID }}</td>
                        <td class="align-middle">{{ $rs->namaDepanAnggota }} {{ $rs->namaBelakangAnggota }}</td>
                        <td class="align-middle">{{ $rs->jenisKelamin }}</td>  
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('anggota.show', $rs->anggotaID) }}" type="button" class="btn btn-secondary">Detail</a>

                                <a href="{{ route('anggota.edit', $rs->anggotaID)}}" type="button" class="btn btn-warning">Edit</a>
                                <form action="{{ route('anggota.destroy', $rs->anggotaID) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
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
                    <td class="text-center" colspan="5">Anggota not found</td>
                </tr>
            @endif
        </tbody>
    </table>



@endsection