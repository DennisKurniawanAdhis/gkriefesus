@extends('layouts.appAgt')
  
@section('title', 'Home Keahlian')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Keahlian</h1>
        <a href="{{ route('keahlian.create') }}" class="btn btn-primary">Add Keahlian</a>
    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    <div class="container">

    
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Nama Keahlian</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>+
            @if($keahlian->count() > 0)
                @foreach($keahlian as $rs)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $rs->namaKeahlian }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('keahlian.show', $rs->keahlianID) }}" type="button" class="btn btn-secondary">Detail</a>
                                <a href="{{ route('keahlian.edit', $rs->keahlianID)}}" type="button" class="btn btn-warning">Edit</a>
                                <form action="{{ route('keahlian.destroy', $rs->keahlianID) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
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
                    <td class="text-center" colspan="5">Keahlian not found</td>
                </tr>
            @endif
        </tbody>
    </table>

    {{-- <div class="d-flex justify-content-center">
        {{ $keahlian->links() }} <!-- Menampilkan tombol pagination -->
    </div> --}}
</div>
@endsection