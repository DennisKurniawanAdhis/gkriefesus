@extends('layouts.appAgt')
  
@section('title', 'Form Kategori Ibadah')
  
@section('contents')
<div class="container">
    
      <!-- ID -->
      <div class="mb-3">
        <label for="ibadahID" class="form-label">ID</label>
        <input type="text" name="ibadahID" class="form-control" id="ibadahID" placeholder="ID Ibadah" value="{{ $jenisIbadah->ibadahID }}" readonly>
    </div>

    <div class="mb-3">
        <label for="namaIbadah" class="form-label">Nama Ibadah</label>
        <input type="text" name="namaIbadah" class="form-control" id="namaIbadah" placeholder="Nama Ibadah" value="{{ $jenisIbadah->namaIbadah }}" readonly>
    </div>

    <div class="mb-3">
        <label for="namaIbadah" class="form-label">Nama Ibadah</label>
        <input type="text" name="namaIbadah" class="form-control" id="namaIbadah" placeholder="Nama Ibadah" value="{{ $jenisIbadah->hari }}" readonly>
    </div>

    <div class="mb-3">
        <label for="waktu" class="form-label">Waktu</label>
        <input type="time" name="waktu" class="form-control w-25" id="waktu" placeholder="HH:MM" value="{{ $jenisIbadah->waktu }}" readonly>
    </div>
    
    

    <div class="mb-3">
        <label for="lokasi" class="form-label">Lokasi</label>
        <input type="text" name="lokasi" class="form-control" id="lokasi" placeholder="Lokasi" value="{{ $jenisIbadah->lokasi }}" readonly>
    </div>

    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <input type="text" name="deskripsi" class="form-control" id="deskripsi" placeholder="Deskripsi" value="{{ $jenisIbadah->deskripsi }}" readonly>
    </div>

    <div class="d-flex align-items-center">
        <button type="submit" class="btn btn-primary mr-3">Save</button>
        <button type="reset" class="btn btn-secondary">Cancel</button>
    </div>

 
</div>
@endsection