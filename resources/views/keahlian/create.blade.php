@extends('layouts.appAgt')
  
@section('title', 'Form Keahlian')
  
@section('contents')
<div class="container">
    <form action="{{ route('keahlian.store') }}" method="POST">
        @csrf
      <!-- ID -->
      {{-- <div class="mb-3">
          <label for="keahlianID" class="form-label">ID</label>
          <input type="text" name="keahlianID" class="form-control" id="keahlianID" placeholder="ID Keahlian" required>
      </div> --}}

      <div class="mb-3">
          <label for="namaKeahlian" class="form-label">Nama Keahlian</label>
          <input type="text" name="namaKeahlian" class="form-control" id="namaKeahlian" placeholder="Nama Keahlian" required>
      </div>

      <div class="mb-3">
          <label for="deskripsi" class="form-label">Deskripsi</label>
          <input type="text" name="deskripsi" class="form-control" id="deskripsi" placeholder="Deskripsi" required>
      </div>

      <!-- Tombol Save dan Cancel -->
      <div class="d-flex align-items-center">
        <button type="submit" class="btn btn-primary mr-3">Save</button>
    </div>
  </form>
</div>
@endsection