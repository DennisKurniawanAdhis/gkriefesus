@extends('layouts.appUang')
  
@section('title', 'Home Perpuluhan')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Perpuluhan</h1>
        <a href="{{ route('perpuluhan.create') }}" class="btn btn-primary">Add Perpuluhan</a>
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
                <th>Nama Anggota</th>
                <th>Tanggal Perpuluhan</th>
                <th>Jumlah Uang</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>+
            @if($perpuluhan->count() > 0)
                @foreach($perpuluhan as $rs)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $rs->anggota->namaDepanAnggota }} {{ $rs->anggota->namaBelakangAnggota }}</td>
                        <td class="align-middle">{{ $rs->formatted_tanggal }}</td>
                        <td class="align-middle">Rp. {{ number_format($rs->jumlahUang, 0, '', '.') }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('perpuluhan.show', $rs->kasID) }}" type="button" class="btn btn-secondary">Detail</a>

                                <a href="{{ route('perpuluhan.edit', $rs->kasID) }}" type="button" class="btn btn-warning">Edit</a>
                                <form action="{{ route('perpuluhan.destroy', $rs->kasID) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
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
                    <td class="text-center" colspan="5">Perpuluhan not found</td>
                </tr>
            @endif
        </tbody>
    </table>



@endsection

