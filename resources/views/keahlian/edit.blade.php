@extends('layouts.appAgt')
  
@section('title', 'Form Keahlian')
  
@section('contents')
<div class="container">
    <form action="{{ route('keahlian.update', $keahlian->keahlianID)  }}" method="POST">
        @csrf
        @method('PUT')
      <!-- ID -->
      <div class="mb-3">
          <label for="keahlianID" class="form-label">ID</label>
          <input type="text" name="keahlianID" class="form-control" id="keahlianID"  placeholder="ID Keahlian" value="{{ $keahlian->keahlianID }}" readonly>
      </div>

      <div class="mb-3">
          <label for="namaKeahlian" class="form-label">Nama Keahlian</label>
          <input type="text" name="namaKeahlian" class="form-control" id="namaKeahlian" placeholder="Nama Keahlian" value="{{ $keahlian->namaKeahlian }}" required>
      </div>

      <div class="mb-3">
          <label for="deskripsi" class="form-label">Deskripsi</label>
          <input type="text" name="deskripsi" class="form-control" id="deskripsi" placeholder="Deskripsi" value="{{ $keahlian->deskripsi }}" required>
      </div>

      <!-- Tombol Save dan Cancel -->
      <div class="d-flex align-items-center">
        <button type="submit" class="btn btn-primary mr-3">Save</button>
        <button type="reset" class="btn btn-secondary">Cancel</button>
    </div>
  </form>
</div>
@endsection