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
    <table class="table table-hover">
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
    </table>
@endsection