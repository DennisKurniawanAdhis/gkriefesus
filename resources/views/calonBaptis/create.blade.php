@extends('layouts.appAgt')
  
@section('title', 'Form Calon Baptis')
  
@section('contents')
<div class="container">
    <form action="{{ route('calonBaptis.store') }}" method="POST">
        @csrf
      <!-- ID -->
      {{-- <div class="mb-3">
          <label for="baptisID" class="form-label">ID</label>
          <input type="text" name="baptisID" class="form-control" id="baptisID" placeholder="ID Baptis">
      </div> --}}

     
      <div class="row mb-3">
        <!-- Dropdown untuk Anggota -->
        <div class="col-md-3">
            <label for="anggotaID" class="form-label">Nama Anggota</label>
        </div>
        <div class="col-md-4">
            <select name="anggotaID" class="form-select" id="anggotaID" required>
                {{-- <option value="">Pilih Anggota</option> --}}
                @foreach ($anggota as $p)
    <option value="{{ $p->anggotaID }}" 
        {{ old('anggotaID') == $p->anggotaID ? 'selected' : '' }}>
        {{ $p->namaDepanAnggota }} {{ $p->namaBelakangAnggota }}
    </option>
@endforeach
            </select>
        </div>
    </div>
    
    <div class="row mb-3">
        <!-- Dropdown untuk Pendeta -->
        <div class="col-md-3">
            <label for="pendetaID" class="form-label">Nama Pendeta</label>
        </div>
        <div class="col-md-4">
            <select name="pendetaID" class="form-select" id="pendetaID" required>
                {{-- <option value="">Pilih Pendeta</option> --}}
                @foreach ($pendeta as $p)
    <option value="{{ $p->pendetaID }}" 
        {{ old('pendetaID') == $p->pendetaID ? 'selected' : '' }}>
        {{ $p->namaDepanPendeta }} {{ $p->namaBelakangPendeta }}
    </option>
@endforeach
            </select>
        </div>
    </div>

    
    <div class="mb-3">
        <label for="namaAyah" class="form-label">Nama Ayah</label>
        <input type="text" name="namaAyah" class="form-control" id="namaAyah" placeholder="Nama Ayah" value="{{ old('namaAyah') }}" required>
    </div>

    <div class="mb-3">
        <label for="namaIbu" class="form-label">Nama Ibu</label>
        <input type="text" name="namaIbu" class="form-control" id="namaIbu" placeholder="Nama Ibu" value="{{ old('namaIbu') }}" required>
    </div>

    <div class="mb-3">
        <label for="tanggalBaptis" class="form-label">Tanggal Baptis</label>
        <input type="date" name="tanggalBaptis" class="form-control" id="tanggalBaptis" placeholder="DD/MM/YYYY" value="{{ old('tanggalBaptis') }}" required>
    </div>
    
      <!-- Nama Depan dan Belakang -->
    

      <!-- Tempat dan Tgl Lahir -->


      <!-- Alamat -->
      <div class="mb-3">
          <label for="namaJalan" class="form-label">Alamat Baptis</label>
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
              <input type="text" name="provinsi" class="form-control" id="provinsi" placeholder="Provinsi" value="{{ old('kota') }}" required>
          </div>
      </div>

    

      <!-- Tombol Save dan Cancel -->
      <div class="d-flex align-items-center">
        <button type="submit" class="btn btn-primary mr-3">Save</button>
    </div>
  </form>
</div>
@endsection