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

    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>ID Baptis</th>
                <th>Nama Calon Baptis</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($baptis->count() > 0)
                @foreach($baptis as $rs)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
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
    </table>


@endsection
