@extends('layouts.appUang')
  
@section('title', 'Home Pengeluaran')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Pengeluaran</h1>
        <a href="{{ route('pengeluaran.create') }}" class="btn btn-primary">Add Pengeluaran</a>
    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('pengeluaran') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <label for="filterPengeluaran" class="form-label">Filter Jenis Pengeluaran</label>
                <select name="filterPengeluaran" id="filterPengeluaran" class="form-control">
                    <option value="">-- All Pengeluaran --</option>
                    <option value="kas" {{ request('filterPengeluaran') == 'kas' ? 'selected' : '' }}>Kas</option>
                    @foreach($jenisIbadah as $ibadah)
                        <option value="{{ $ibadah->namaIbadah }}" {{ request('filterPengeluaran') == $ibadah->namaIbadah ? 'selected' : '' }}>
                           Ibadah {{ $ibadah->namaIbadah }}
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
                <th>Nama Pengeluaran</th>
                <th>Tanggal Pengeluaran</th>
                <th>Jumlah Uang</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>+
            @if($pengeluaran->count() > 0)
                @foreach($pengeluaran as $rs)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td>{{ $rs->jenisIbadah ? 'Ibadah ' . $rs->jenisIbadah->namaIbadah : 'Kas' }}</td>                    
                        <td class="align-middle">{{ $rs->formatted_tanggal }}</td>
                        <td class="align-middle">Rp. {{ number_format($rs->jumlahUang, 0, '', '.') }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('pengeluaran.show', $rs->pengeluaranID) }}" type="button" class="btn btn-secondary">Detail</a>

                                <a href="{{ route('pengeluaran.edit', $rs->pengeluaranID) }}" type="button" class="btn btn-warning">Edit</a>
                                <form action="{{ route('pengeluaran.destroy', $rs->pengeluaranID) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
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
                    <td class="text-center" colspan="5">Pengeluaran not found</td>
                </tr>
            @endif
        </tbody>
    </table>



@endsection

