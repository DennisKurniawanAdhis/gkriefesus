@extends('layouts.appUang')
  
@section('title', 'Home Kolekte')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Kolekte</h1>
        <a href="{{ route('kolekte.create') }}" class="btn btn-primary">Add Kolekte</a>
    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

      <!-- Filter Form -->
      <form method="GET" action="{{ route('kolekte') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <label for="namaIbadah" class="form-label">Filter Nama Ibadah</label>
                <select name="namaIbadah" id="namaIbadah" class="form-control">
                    <option value="">-- All Ibadah --</option>
                    @foreach($allIbadah as $ibd)
                        <option value="{{ $ibd->namaIbadah }}" {{ request('namaIbadah') == $ibd->namaIbadah ? 'selected' : '' }}>
                            {{ $ibd->namaIbadah }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Nama Ibadah</th>
                <th>Tanggal Kolekte</th>
                <th>Jumlah Uang</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>+
            @if($kolekte->count() > 0)
                @foreach($kolekte as $rs)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $rs->jenisIbadah->namaIbadah}} </td>
                        <td class="align-middle">{{ $rs->formatted_tanggal }}</td>
                        <td class="align-middle">Rp. {{ number_format($rs->jumlahUang, 0, '', '.') }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('kolekte.show', $rs->kasID) }}" type="button" class="btn btn-secondary">Detail</a>

                                <a href="{{ route('kolekte.edit', $rs->kasID) }}" type="button" class="btn btn-warning">Edit</a>
                                <form action="{{ route('kolekte.destroy', $rs->kasID) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
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
                    <td class="text-center" colspan="5">Kolekte not found</td>
                </tr>
            @endif
        </tbody>
    </table>



@endsection

