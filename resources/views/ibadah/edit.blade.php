@extends('layouts.appAgt')
  
@section('title', 'Form Ibadah')
  
@section('contents')
<div class="container">
    <form action="{{ route('ibadah.update', $dataIbadah->dataIbadahID) }}" method="POST">
        @csrf
        @method('PUT')
     
        <div class="row mb-3">
            <!-- Dropdown untuk Pria -->
            <div class="col-md-3">
                <label for="ibadahID" class="form-label">Nama Ibadah</label>
            </div>
            <div class="col-md-4">
                <select name="ibadahID" class="form-select" id="ibadahID" required>
                    @foreach ($jenisIbadah as $p)
                        <option value="{{ $p->ibadahID }}" {{ $p->ibadahID == $dataIbadah->ibadahID ? 'selected' : '' }}>
                            {{ $p->namaIbadah }}
                        </option>
                    @endforeach
                </select>
                
            </div>
        </div>

        <div class="row mb-3">
            <!-- Dropdown untuk Pria -->
            <div class="col-md-3">
                <label for="pendetaID" class="form-label">Nama Pendeta</label>
            </div>
            <div class="col-md-4">
                <select name="pendetaID" class="form-select" id="pendetaID" required>
                    @foreach ($pendeta as $p)
                        <option value="{{ $p->pendetaID }}" {{ $pendetaTerpilih }}>
                            {{ $p->namaDepanPendeta }} {{ $p->namaBelakangPendeta }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>


    <div class="mb-3">
        <label for="tanggalIbadah" class="form-label">Tanggal Ibadah</label>
        <input type="date" name="tanggalIbadah" class="form-control" id="tanggalIbadah" placeholder="DD/MM/YYYY" value="{{ $dataIbadah->tanggalIbadah }}" required>
    </div>
    
      <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <input type="text" name="deskripsi" class="form-control" id="deskripsi" placeholder="Deskripsi" value="{{ $dataIbadah->deskripsi }}" required>
    </div>

      <!-- Tombol Save dan Cancel -->
      <div class="d-flex align-items-center">
        <button type="submit" class="btn btn-primary mr-3">Save</button>
        <button type="reset" class="btn btn-secondary">Cancel</button>
    </div>
  </form>
</div>
@endsection