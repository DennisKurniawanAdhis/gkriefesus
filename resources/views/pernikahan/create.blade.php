@extends('layouts.appAgt')
  
@section('title', 'Form Pernikahan')
  
@section('contents')
<div class="container">
    <form action="{{ route('pernikahan.store') }}" method="POST">
        @csrf
      <!-- ID -->
      <div class="mb-3">
          <label for="pernikahanID" class="form-label">ID</label>
          <input type="text" name="pernikahanID" class="form-control" id="pernikahanID" placeholder="ID Pernikahan" required>
      </div>

      <div class="container">
        <div class="row mb-3">
            <!-- Dropdown untuk Pria -->
            <div class="col-md-3">
                <label for="anggotaID_suami" class="form-label">Nama Pasangan Pria</label>
            </div>
            <div class="col-md-4">
                <select name="anggotaID_suami" class="form-select" id="anggotaID_suami" required>
                    @foreach ($pria as $p)
                        <option value="{{ $p->anggotaID }}">
                            {{ $p->namaDepanAnggota }} {{ $p->namaBelakangAnggota }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    
        <div class="row mb-3">
            <!-- Dropdown untuk Wanita -->
            <div class="col-md-3">
                <label for="anggotaID_istri" class="form-label">Nama Pasangan Wanita</label>
            </div>
            <div class="col-md-4">
                <select name="anggotaID_istri" class="form-select" id="anggotaID_istri" required>
                    @foreach ($wanita as $p)
                        <option value="{{ $p->anggotaID }}">
                            {{ $p->namaDepanAnggota }} {{ $p->namaBelakangAnggota }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    
        <div class="row mb-3">
            <!-- Dropdown untuk Pendeta -->
            <div class="col-md-3">
                <label for="pendetaID" class="form-label">Pendeta</label>
            </div>
            <div class="col-md-4">
                <select name="pendetaID" class="form-select" id="pendetaID" required>
                    @foreach ($pendeta as $p)
                        <option value="{{ $p->pendetaID }}">
                            {{ $p->namaDepanPendeta }} {{ $p->namaBelakangPendeta }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    
    

    <div class="mb-3">
        <label for="tanggalPernikahan" class="form-label">Tanggal Pernikahan</label>
        <input type="date" name="tanggalPernikahan" class="form-control" id="tanggalPernikahan" placeholder="DD/MM/YYYY" required>
    </div>
    
    <div class="mb-3">
        <label for="namaOrangKua" class="form-label">Nama Pihak Kua</label>
        <input type="text" name="namaOrangKua" class="form-control" id="namaOrangKua" placeholder="Nama Pihak Kua" required>
    </div>
    
    <div class="mb-3">
        <label for="noStbld" class="form-label">Nomor Stbld</label>
        <input type="text" name="noStbld" class="form-control" id="noStbld" placeholder="Nomor Stbld" required>
    </div>

      <!-- Nama Depan dan Belakang -->
    

      <!-- Tempat dan Tgl Lahir -->


      <!-- Alamat -->
      <div class="mb-3">
          <label for="namaJalan" class="form-label">Alamat Pernikahan</label>
          <input type="text" name="namaJalan" class="form-control" id="namaJalan" placeholder="Nama Jalan" required>
      </div>

      <!-- RT, RW, Kode Pos -->
      <div class="row">
          <div class="col-md-2 mb-3">
              <input type="number" name="RT" class="form-control" id="RT" placeholder="RT" required>
          </div>
          <div class="col-md-2 mb-3">
              <input type="number" name="RW" class="form-control" id="RW" placeholder="RW" required>
          </div>
          <div class="col-md-4 mb-3">
              <input type="number" name="kodePos" class="form-control" id="kodePos" placeholder="Kode Pos" required>
          </div>
      </div>

      <!-- Kelurahan, Kecamatan, Kota, Provinsi -->
      <div class="row">
          <div class="col-md-3 mb-3">
              <input type="text" name="kelurahan" class="form-control" id="kelurahan" placeholder="Kelurahan" required>
          </div>
          <div class="col-md-3 mb-3">
              <input type="text" name="kecamatan" class="form-control" id="kecamatan" placeholder="Kecamatan" required>
          </div>
          <div class="col-md-3 mb-3">
              <input type="text" name="kota" class="form-control" id="kota" placeholder="Kota" required>
          </div>
          <div class="col-md-3 mb-3">
              <input type="text" name="provinsi" class="form-control" id="provinsi" placeholder="Provinsi" required>
          </div>
      </div>

    

      <!-- Tombol Save dan Cancel -->
      <div class="d-flex align-items-center">
        <button type="submit" class="btn btn-primary mr-3">Save</button>
        <button type="reset" class="btn btn-secondary">Cancel</button>
    </div>
  </form>
</div>
@endsection