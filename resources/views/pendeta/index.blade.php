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
                <th>#</th>
                <th>ID Pendeta</th>
                <th>Nama pendeta</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>+
            @if($pendeta->count() > 0)
                @foreach($pendeta as $rs)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $rs->pendetaID }}</td>
                        <td class="align-middle">{{ $rs->namaDepanPendeta }} {{ $rs->namaBelakangPendeta }}</td> 
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('pendeta.show', $rs->pendetaID) }}" type="button" class="btn btn-secondary">Detail</a>

                                <a href="{{ route('pendeta.edit', $rs->pendetaID)}}" type="button" class="btn btn-warning">Edit</a>
                                <form action="{{ route('pendeta.destroy', $rs->pendetaID) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
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
                    <td class="text-center" colspan="5">Pendeta not found</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection