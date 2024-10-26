@extends('layouts.appAgt')
  
@section('title', 'Form Anggota')
  
@section('contents')
<div class="container">
    <form action="{{ route('anggota.update', $anggota->anggotaID) }}" method="POST">
        @csrf
        @method('PUT')
      <!-- ID -->
      <div class="mb-3">
          <label for="anggotaID" class="form-label">ID</label>
          <input type="text" name="anggotaID" class="form-control" id="anggotaID" placeholder="ID Anggota" value="{{ $anggota->anggotaID }}" readonly>
      </div>

      <!-- Nama Depan dan Belakang -->
      <div class="row">
          <div class="col-md-6 mb-3">
              <label for="namaDepanAnggota" class="form-label">Nama Depan</label>
              <input type="text" name="namaDepanAnggota" class="form-control" id="namaDepanAnggota" placeholder="Nama Depan" value="{{ $anggota->namaDepanAnggota }}" required>
          </div>
          <div class="col-md-6 mb-3">
              <label for="namaBelakangAnggota" class="form-label">Nama Belakang</label>
              <input type="text" name="namaBelakangAnggota" class="form-control" id="namaBelakangAnggota" placeholder="Nama Belakang" value="{{ $anggota->namaBelakangAnggota }}" required>
          </div>
      </div>

      <!-- Tempat dan Tgl Lahir -->
      <div class="row">
          <div class="col-md-6 mb-3">
              <label for="tempatLahir" class="form-label">Tempat Lahir</label>
              <input type="text" name="tempatLahir" class="form-control" id="tempatLahir" placeholder="Tempat Lahir" value="{{ $anggota->tempatLahir }}" required>
          </div>
          <div class="col-md-6 mb-3">
              <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
              <input type="date" name="tanggalLahir" class="form-control" id="tanggalLahir" placeholder="DD/MM/YYYY" value="{{ $anggota->tanggalLahir }}" required>
          </div>
      </div>

      <!-- Alamat -->
      <div class="mb-3">
          <label for="namaJalan" class="form-label">Alamat</label>
          <input type="text" name="namaJalan" class="form-control" id="namaJalan" placeholder="Nama Jalan" value="{{ $alamatAnggota->namaJalan }}" required>
      </div>

      <!-- RT, RW, Kode Pos -->
      <div class="row">
          <div class="col-md-2 mb-3">
              <input type="number" name="RT" class="form-control" id="RT" placeholder="RT" value="{{ $alamatAnggota->RT }}" required>
          </div>
          <div class="col-md-2 mb-3">
              <input type="number" name="RW" class="form-control" id="RW" placeholder="RW" value="{{ $alamatAnggota->RW }}" required>
          </div>
          <div class="col-md-4 mb-3">
              <input type="text" name="kodePos" class="form-control" id="kodePos" placeholder="Kode Pos" value="{{ $alamatAnggota->kodePos }}" required>
          </div>
      </div>

      <!-- Kelurahan, Kecamatan, Kota, Provinsi -->
      <div class="row">
          <div class="col-md-3 mb-3">
              <input type="text" name="kelurahan" class="form-control" id="kelurahan" placeholder="Kelurahan" value="{{ $alamatAnggota->kelurahan }}" required>
          </div>
          <div class="col-md-3 mb-3">
              <input type="text" name="kecamatan" class="form-control" id="kecamatan" placeholder="Kecamatan" value="{{ $alamatAnggota->kecamatan }}" required>
          </div>
          <div class="col-md-3 mb-3">
              <input type="text" name="kota" class="form-control" id="kota" placeholder="Kota" value="{{ $alamatAnggota->kota }}" required>
          </div>
          <div class="col-md-3 mb-3">
              <input type="text" name="provinsi" class="form-control" id="provinsi" placeholder="Provinsi" value="{{ $alamatAnggota->provinsi }}" required>
          </div>
      </div>

      <!-- No Telp -->
      <div class="mb-3">
          <label for="noTelp" class="form-label">No Telp</label>
          <input type="number" name="noTelp" class="form-control" id="noTelp" placeholder="Nomor Telepon" value="{{ $anggota->noTelp }}" required>
      </div>

      <div class="mb-3">
          <label for="pekerjaan" class="form-label">Pekerjaan</label>
          <input type="text" name="pekerjaan" class="form-control" id="pekerjaan" placeholder="Pekerjaan" value="{{ $anggota->pekerjaan }}" required>
      </div>

      <!-- Status Kawin dan Jenis Kelamin -->
      <div class="row">
        <div class="col-md-6 mb-3">
            <label for="statusKawin" class="form-label">Status Kawin</label>
            <select name="statusKawin" class="form-select" id="statusKawin">
                @foreach ($statusKawin as $key => $value)
                    <option value="{{ $key }}" 
                        @if ($anggota->statusKawin == $key) selected @endif>
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
                        @if ($anggota->jenisKelamin == $key) selected @endif>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    

      <!-- Jenis Ibadah -->
      <div class="mb-3">
        <label for="JenisIbadah" class="form-label">Jenis Ibadah</label>
        @if($jenisIbadah->isEmpty())
        <p>Belum ada data ibadah</p>
    @else
        @foreach ($jenisIbadah as $ibadah)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="jenisIbadah[]" value="{{ $ibadah->ibadahID }}" id="{{ $ibadah->namaIbadah }}" 
                {{ $selectedIbadah->contains($ibadah->ibadahID) ? 'checked' : '' }}>
                <label class="form-check-label" for="{{ $ibadah->namaIbadah }}">
                    {{ $ibadah->namaIbadah }}
                </label>
            </div>
        @endforeach
        @endif
    </div>
    
    
    <div class="mb-3">
        <label for="keahlian" class="form-label">Keahlian</label>
        @if($keahlian->isEmpty())
        <p>Belum ada data keahlian</p>
    @else
        @foreach ($keahlian as $ini)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="keahlian[]" value="{{ $ini->keahlianID }}" id="{{ $ini->namaKeahlian }}" 
                {{ $selectedKeahlian->contains($ini->keahlianID) ? 'checked' : '' }}>  <!-- Perubahan di sini -->
                <label class="form-check-label" for="{{ $ini->namaKeahlian }}">
                    {{ $ini->namaKeahlian }}
                </label>
            </div>
        @endforeach
        @endif
    </div>
    
      <!-- Keahlian -->

      {{-- @include('layouts.keahlianEdit') --}}
    
      <!-- NIK dan No Kartu Keluarga -->
      <div class="mb-3">
          <label for="NIK" class="form-label">NIK</label>
          <input type="number" name="NIK" class="form-control" id="NIK" placeholder="NIK" value="{{ $anggota->NIK }}" required>
      </div>
      <div class="mb-3">
          <label for="noKK" class="form-label">No Kartu Keluarga</label>
          <input type="number" name="noKK" class="form-control" id="noKK" placeholder="No Kartu Keluarga" value="{{ $anggota->noKK }}" required>
      </div>

      <!-- Tombol Save dan Cancel -->
      <div class="d-flex align-items-center">
        <button type="submit" class="btn btn-primary mr-3">Save</button>
    </div>
  </form>
</div>
@endsection