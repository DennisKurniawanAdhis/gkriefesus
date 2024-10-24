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
    <table class="table table-hover">
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
    </table>
    
@endsection