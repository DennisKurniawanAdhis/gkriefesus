@extends('layouts.appAgt')
  
@section('title', 'Form Pendeta')
  
@section('contents')
<div class="container">
    <form action="{{ route('pendeta.update', $pendeta->pendetaID) }}" method="POST">
        @csrf
        @method('PUT')
      <!-- ID -->
      <div class="mb-3">
          <label for="pendetaID" class="form-label">ID</label>
          <input type="text" name="pendetaID" class="form-control" id="pendetaID" placeholder="ID Pendeta" value="{{ $pendeta->pendetaID }}" readonly>
      </div>

      <!-- Nama Depan dan Belakang -->
      <div class="row">
          <div class="col-md-6 mb-3">
              <label for="namaDepanPendeta" class="form-label">Nama Depan</label>
              <input type="text" name="namaDepanPendeta" class="form-control" id="namaDepanPendeta" placeholder="Nama Depan" value="{{ $pendeta->namaDepanPendeta }}" required>
          </div>
          <div class="col-md-6 mb-3">
              <label for="namaBelakangPendeta" class="form-label">Nama Belakang</label>
              <input type="text" name="namaBelakangPendeta" class="form-control" id="namaBelakangPendeta" placeholder="Nama Belakang" value="{{ $pendeta->namaBelakangPendeta }}" required>
          </div>
      </div>

      <!-- Tempat dan Tgl Lahir -->
      <div class="row">
          <div class="col-md-6 mb-3">
              <label for="tempatLahir" class="form-label">Tempat Lahir</label>
              <input type="text" name="tempatLahir" class="form-control" id="tempatLahir" placeholder="Tempat Lahir" value="{{ $pendeta->tempatLahir }}" required>
          </div>
          <div class="col-md-6 mb-3">
              <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
              <input type="date" name="tanggalLahir" class="form-control" id="tanggalLahir" placeholder="DD/MM/YYYY" value="{{ $pendeta->tanggalLahir }}" required> 
          </div>
      </div>

      <!-- Alamat -->
      <div class="mb-3">
          <label for="namaJalan" class="form-label">Alamat</label>
          <input type="text" name="namaJalan" class="form-control" id="namaJalan" placeholder="Nama Jalan" value="{{ $alamatPendeta->namaJalan }}" required>
      </div>

      <!-- RT, RW, Kode Pos -->
      <div class="row">
          <div class="col-md-2 mb-3">
              <input type="number" name="RT" class="form-control" id="RT" placeholder="RT" value="{{ $alamatPendeta->RT }}" required>
          </div>
          <div class="col-md-2 mb-3">
              <input type="number" name="RW" class="form-control" id="RW" placeholder="RW" value="{{ $alamatPendeta->RW }}" required>
          </div>
          <div class="col-md-4 mb-3">
              <input type="number" name="kodePos" class="form-control" id="kodePos" placeholder="Kode Pos" value="{{ $alamatPendeta->kodePos }}" required>
          </div>
      </div>

      <!-- Kelurahan, Kecamatan, Kota, Provinsi -->
      <div class="row">
          <div class="col-md-3 mb-3">
              <input type="text" name="kelurahan" class="form-control" id="kelurahan" placeholder="Kelurahan" value="{{ $alamatPendeta->kelurahan }}" required>
          </div>
          <div class="col-md-3 mb-3">
              <input type="text" name="kecamatan" class="form-control" id="kecamatan" placeholder="Kecamatan" value="{{ $alamatPendeta->kecamatan }}" required>
          </div>
          <div class="col-md-3 mb-3">
              <input type="text" name="kota" class="form-control" id="kota" placeholder="Kota" value="{{ $alamatPendeta->kota }}" required>
          </div>
          <div class="col-md-3 mb-3">
              <input type="text" name="provinsi" class="form-control" id="provinsi" placeholder="Provinsi" value="{{ $alamatPendeta->provinsi }}" required>
          </div>
      </div>

      <!-- No Telp -->
      <div class="mb-3">
          <label for="noTelp" class="form-label">No Telp</label>
          <input type="number" name="noTelp" class="form-control" id="noTelp" placeholder="Nomor Telepon" value="{{ $pendeta->noTelp }}" required>
      </div>

      <div class="mb-3">
          <label for="pekerjaan" class="form-label">Pekerjaan</label>
          <input type="text" name="pekerjaan" class="form-control" id="pekerjaan" placeholder="Pekerjaan" value="{{ $pendeta->pekerjaan }}" required>
      </div>

      <div class="mb-3">
          <label for="gelar" class="form-label">Gelar</label>
          <input type="text" name="gelar" class="form-control" id="gelar" placeholder="Gelar" value="{{ $pendeta->gelar }}" required>
      </div>

      <!-- Status Kawin dan Jenis Kelamin -->
      <div class="row">
        <div class="col-md-6 mb-3">
            <label for="statusKawin" class="form-label">Status Kawin</label>
            <select name="statusKawin" class="form-select" id="statusKawin">
                @foreach ($statusKawin as $key => $value)
                    <option value="{{ $key }}" 
                        @if ($pendeta->statusKawin == $key) selected @endif>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
            <select name="jenisKelamin" class="form-select" id="jenisKelamin">
                @foreach ($jenisKelamin as $key => $value)
                    <option value="{{ $key }}" 
                        @if ($pendeta->jenisKelamin == $key) selected @endif>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    

      <!-- Jenis Ibadah -->
    
      <!-- Keahlian -->

      {{-- @include('layouts.keahlianEdit') --}}
    
      <!-- NIK dan No Kartu Keluarga -->
      <div class="mb-3">
          <label for="NIK" class="form-label">NIK</label>
          <input type="number" name="NIK" class="form-control" id="NIK" placeholder="NIK" value="{{ $pendeta->NIK }}" required>
      </div>
      <div class="mb-3">
          <label for="noKK" class="form-label">No Kartu Keluarga</label>
          <input type="number" name="noKK" class="form-control" id="noKK" placeholder="No Kartu Keluarga" value="{{ $pendeta->noKK }}" required>
      </div>

      <!-- Tombol Save dan Cancel -->
      <div class="d-flex align-items-center">
        <button type="submit" class="btn btn-primary mr-3">Save</button>
        <button type="reset" class="btn btn-secondary">Cancel</button>
    </div>
  </form>
</div>
@endsection