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
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>ID Pernikahan</th>
                <th>Nama Pasangan Pria</th>
                <th>Nama Pasangan Wanita</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>+
            @if($pernikahan->count() > 0)
                @foreach($pernikahan as $rs)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $rs->pernikahanID }}</td>
                        <td class="align-middle">{{ $rs->nama_suami }} </td>
                        <td class="align-middle">{{ $rs->nama_istri }} </td> 
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('pernikahan.show', $rs->pernikahanID) }}" type="button" class="btn btn-secondary">Detail</a>

                                <a href="{{ route('pernikahan.edit', $rs->pernikahanID)}}" type="button" class="btn btn-warning">Edit</a>
                                <form action="{{ route('pernikahan.destroy', $rs->pernikahanID) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
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