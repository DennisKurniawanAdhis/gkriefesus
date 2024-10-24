@extends('layouts.appAgt')
  
@section('title', 'Home Ibadah')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Ibadah</h1>
        <a href="{{ route('ibadah.create') }}" class="btn btn-primary">Add Ibadah</a>
    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

      <!-- Filter berdasarkan kategori jenis ibadah -->
      <form action="{{ route('ibadah') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <select name="ibadahID" class="form-control">
                    <option value="">-- Semua Kategori Ibadah --</option>
                    @foreach($jenisIbadah as $jenis)
                        <option value="{{ $jenis->ibadahID }}" 
                            {{ request()->ibadahID == $jenis->ibadahID ? 'selected' : '' }}>
                            {{ $jenis->namaIbadah }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Nama Ibadah</th>
                <th>Tanggal</th>
                <th>Nama Pendeta</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>+
            @if($ibadah->count() > 0)
                @foreach($ibadah as $rs)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $rs->jenisIbadah->namaIbadah }}</td>
                        <td class="align-middle">{{ $rs->formatted_tanggal_ibadah }}</td>
                        <td class="align-middle">{{ $rs->pendeta->namaDepanPendeta  }} {{ $rs->pendeta->namaBelakangPendeta }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('ibadah.show', $rs->dataIbadahID) }}" type="button" class="btn btn-secondary">Detail</a>

                                <a href="{{ route('ibadah.edit', $rs->dataIbadahID) }}" type="button" class="btn btn-warning">Edit</a>
                                <form action="{{ route('ibadah.destroy', $rs->dataIbadahID) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
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
                    <td class="text-center" colspan="5">Calon Baptis not found</td>
                </tr>
            @endif
        </tbody>
    </table>



@endsection

