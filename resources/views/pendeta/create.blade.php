@extends('layouts.appAgt')
  
@section('title', 'Form Pendeta')
  
@section('contents')
<div class="container">
    <form action="{{ route('pendeta.store') }}" method="POST">
        @csrf
      <!-- ID -->
      {{-- <div class="mb-3">
          <label for="pendetaID" class="form-label">ID</label>
          <input type="text" name="pendetaID" class="form-control" id="pendetaID" placeholder="ID Pendeta" required>
      </div> --}}

      <!-- Nama Depan dan Belakang -->
      <div class="row">
          <div class="col-md-6 mb-3">
              <label for="namaDepanPendeta" class="form-label">Nama Depan</label>
              <input type="text" name="namaDepanPendeta" class="form-control" id="namaDepanPendeta" placeholder="Nama Depan" value="{{ old('namaDepanPendeta') }}" required>
          </div>
          <div class="col-md-6 mb-3">
              <label for="namaBelakangPendeta" class="form-label">Nama Belakang</label>
              <input type="text" name="namaBelakangPendeta" class="form-control" id="namaBelakangPendeta" placeholder="Nama Belakang" value="{{ old('namaBelakangPendeta') }}" required>
          </div>
      </div>

      <!-- Tempat dan Tgl Lahir -->
      <div class="row">
          <div class="col-md-6 mb-3">
              <label for="tempatLahir" class="form-label">Tempat Lahir</label>
              <input type="text" name="tempatLahir" class="form-control" id="tempatLahir" placeholder="Tempat Lahir" value="{{ old('tempatLahir') }}" required>
          </div>
          <div class="col-md-6 mb-3">
              <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
              <input type="date" name="tanggalLahir" class="form-control" id="tanggalLahir" placeholder="DD/MM/YYYY" value="{{ old('tanggalLahir') }}" required>
          </div>
      </div>

      <!-- Alamat -->
      <div class="mb-3">
          <label for="namaJalan" class="form-label">Alamat</label>
          <input type="text" name="namaJalan" class="form-control" id="namaJalan" placeholder="Nama Jalan" value="{{ old('namaJalan') }}" required>
      </div>

      <!-- RT, RW, Kode Pos -->
      <div class="row">
        <div class="col-md-2 mb-3">
            <input type="text" name="RT" class="form-control @error('RT') is-invalid @enderror" id="RT" placeholder="RT" value="{{ old('RT') }}" required>
            @error('RT')
                <div class="alert alert-warning" role="alert">
                    <span class="font-medium">{{ $message }}</span>
                </div>
            @enderror
        </div> 
          <div class="col-md-2 mb-3">
              <input type="number" name="RW" class="form-control @error('RT') is-invalid @enderror" id="RW" placeholder="RW" value="{{ old('RW') }}" required>
              @error('RW')
              <div class="alert alert-warning" role="alert">
                  <span class="font-medium">{{ $message }}</span>
              </div>
          @enderror
          </div>
          <div class="col-md-4 mb-3">
              <input type="number" name="kodePos" class="form-control @error('kodePos') is-invalid @enderror" id="kodePos" placeholder="Kode Pos" value="{{ old('kodePos') }}" required>
              @error('kodePos')
              <div class="alert alert-warning" role="alert">
                  <span class="font-medium">{{ $message }}</span>
              </div>
          @enderror
          </div>
      </div>

      <!-- Kelurahan, Kecamatan, Kota, Provinsi -->
      <div class="row">
          <div class="col-md-3 mb-3">
              <input type="text" name="kelurahan" class="form-control" id="kelurahan" placeholder="Kelurahan" value="{{ old('kelurahan') }}" required>
          </div>
          <div class="col-md-3 mb-3">
              <input type="text" name="kecamatan" class="form-control" id="kecamatan" placeholder="Kecamatan" value="{{ old('kecamatan') }}" required>
          </div>
          <div class="col-md-3 mb-3">
              <input type="text" name="kota" class="form-control" id="kota" placeholder="Kota" value="{{ old('kota') }}" required>
          </div>
          <div class="col-md-3 mb-3">
              <input type="text" name="provinsi" class="form-control" id="provinsi" placeholder="Provinsi" value="{{ old('provinsi') }}" required>
          </div>
      </div>

      <!-- No Telp -->
      <div class="mb-3">
        <label for="noTelp" class="form-label">No Telp</label>
        <input type="number" name="noTelp" class="form-control" id="noTelp" placeholder="Nomor Telepon" value="{{ old('noTelp') }}" required>
        @error('noTelp')
            <div class="alert alert-warning" role="alert">
                <span class="font-medium">{{ $message }}</span>
            </div>
        @enderror
    </div>

      <div class="mb-3">
          <label for="pekerjaan" class="form-label">Pekerjaan</label>
          <input type="text" name="pekerjaan" class="form-control" id="pekerjaan" placeholder="Pekerjaan" value="{{ old('pekerjaan') }}" required>
      </div>

      <div class="mb-3">
        <label for="gelar" class="form-label">Gelar</label>
        <input type="text" name="gelar" class="form-control" id="gelar" placeholder="Gelar" value="{{ old('gelar') }}" required>
    </div>

      <!-- Status Kawin dan Jenis Kelamin -->
      <div class="row">
        <div class="col-md-6 mb-3">
            <label for="statusKawin" class="form-label">Status Kawin</label>
            <select name="statusKawin" class="form-select" id="statusKawin" required>
                @foreach ($statusKawin as $key => $value)
                    <option value="{{ $key }}" {{ old('statusKawin') == $key ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
            <select name="jenisKelamin" class="form-select" id="jenisKelamin" required>
                @foreach ($jenisKelamin as $key => $value)
                    <option value="{{ $key }}" {{ old('jenisKelamin') == $key ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>

      <!-- Jenis Ibadah -->

      <!-- Keahlian -->

      {{-- @include('layouts.keahlian') --}}
    
      <!-- NIK dan No Kartu Keluarga -->
      <div class="mb-3">
        <label for="NIK" class="form-label">NIK</label>
        <input type="number" name="NIK" class="form-control @error('NIK') is-invalid @enderror" id="NIK" placeholder="NIK" value="{{ old('NIK') }}" required>
        @error('NIK')
        <div class="alert alert-warning" role="alert">
            <span class="font-medium">{{ $message }}</span>
        </div>
    @enderror
    </div>
    <div class="mb-3">
        <label for="noKK" class="form-label">No Kartu Keluarga</label>
        <input type="number" name="noKK" class="form-control @error('noKK') is-invalid @enderror" id="noKK" placeholder="No Kartu Keluarga" value="{{ old('noKK') }}" required>
        @error('noKK')
        <div class="alert alert-warning" role="alert">
            <span class="font-medium">{{ $message }}</span>
        </div>
    @enderror
    </div>

      <!-- Tombol Save dan Cancel -->
      <div class="d-flex align-items-center">
        <button type="submit" class="btn btn-primary mr-3">Save</button>
    </div>
  </form>
</div>
@endsection