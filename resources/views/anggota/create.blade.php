@extends('layouts.appAgt')
  
@section('title', 'Form Anggota')
  
@section('contents')
<div class="container">
    <form action="{{ route('anggota.store') }}" method="POST">
        @csrf
      <!-- ID -->
      <div class="mb-3">
          <label for="anggotaID" class="form-label">ID</label>
          <input type="text" name="anggotaID" class="form-control" id="anggotaID" placeholder="ID Anggota" required>
      </div>

      <!-- Nama Depan dan Belakang -->
      <div class="row">
          <div class="col-md-6 mb-3">
              <label for="namaDepanAnggota" class="form-label">Nama Depan</label>
              <input type="text" name="namaDepanAnggota" class="form-control" id="namaDepanAnggota" placeholder="Nama Depan" required>
          </div>
          <div class="col-md-6 mb-3">
              <label for="namaBelakangAnggota" class="form-label">Nama Belakang</label>
              <input type="text" name="namaBelakangAnggota" class="form-control" id="namaBelakangAnggota" placeholder="Nama Belakang" required>
          </div>
      </div>

      <!-- Tempat dan Tgl Lahir -->
      <div class="row">
          <div class="col-md-6 mb-3">
              <label for="tempatLahir" class="form-label">Tempat Lahir</label>
              <input type="text" name="tempatLahir" class="form-control" id="tempatLahir" placeholder="Tempat Lahir" required>
          </div>
          <div class="col-md-6 mb-3">
              <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
              <input type="date" name="tanggalLahir" class="form-control" id="tanggalLahir" placeholder="DD/MM/YYYY" required>
          </div>
      </div>

      <!-- Alamat -->
      <div class="mb-3">
          <label for="namaJalan" class="form-label">Alamat</label>
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

      <!-- No Telp -->
      <div class="mb-3">
          <label for="noTelp" class="form-label">No Telp</label>
          <input type="number" name="noTelp" class="form-control" id="noTelp" placeholder="Nomor Telepon" required>
      </div>

      <div class="mb-3">
          <label for="pekerjaan" class="form-label">Pekerjaan</label>
          <input type="text" name="pekerjaan" class="form-control" id="pekerjaan" placeholder="Pekerjaan" required>
      </div>

      <!-- Status Kawin dan Jenis Kelamin -->
      <div class="row">
          <div class="col-md-6 mb-3">
              <label for="statusKawin" class="form-label">Status Kawin</label>
              <select name="statusKawin" class="form-select" id="statusKawin" required>
                @foreach ($statusKawin as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
          </div>
          <div class="col-md-6 mb-3">
              <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
              <select name="jenisKelamin" class="form-select" id="jenisKelamin" required>
                @foreach ($jenisKelamin as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
          </div>
      </div>

      <!-- Jenis Ibadah -->
      <div class="mb-3">
          <label for="JenisIbadah" class="form-label">Jenis Ibadah</label>
          @foreach ($jenisIbadah as $ibadah)
          <div class="form-check">
              <!-- Ganti 'id' menjadi 'ibadahID' sebagai value -->
              <input class="form-check-input" type="checkbox" name="jenisIbadah[]" value="{{ $ibadah->ibadahID }}" id="{{ $ibadah->namaIbadah }}" >
              
              <!-- Label untuk checkbox menggunakan namaIbadah -->
              <label class="form-check-label" for="{{ $ibadah->namaIbadah }}">
                  {{ $ibadah->namaIbadah }}
              </label>
          </div>
      @endforeach
      </div> 

      

      <div class="mb-3">
        <label for="Keahlian" class="form-label">Keahlian</label>
        @foreach ($keahlian as $ini)
        <div class="form-check">
            <!-- Ganti 'id' menjadi 'ibadahID' sebagai value -->
            <input class="form-check-input" type="checkbox" name="keahlian[]" value="{{ $ini->keahlianID }}" id="{{ $ini->namaKeahlian }}">
            
            <!-- Label untuk checkbox menggunakan namaIbadah -->
            <label class="form-check-label" for="{{ $ini->namaKeahlian }}">
                {{ $ini->namaKeahlian }}
            </label>
        </div>
    @endforeach
    </div>

      <!-- Keahlian -->

      {{-- @include('layouts.keahlian') --}}
    
      <!-- NIK dan No Kartu Keluarga -->
      <div class="mb-3">
          <label for="NIK" class="form-label">NIK</label>
          <input type="number" name="NIK" class="form-control" id="NIK" placeholder="NIK" required>
      </div>
      <div class="mb-3">
          <label for="noKK" class="form-label">No Kartu Keluarga</label>
          <input type="number" name="noKK" class="form-control" id="noKK" placeholder="No Kartu Keluarga" required>
      </div>

      <!-- Tombol Save dan Cancel -->
      <div class="d-flex align-items-center">
        <button type="submit" class="btn btn-primary mr-3">Save</button>
        <button type="reset" class="btn btn-secondary">Cancel</button>
    </div>
  </form>
</div>
@endsection

<script>
    document.querySelector('form').addEventListener('submit', function(e) {
        const checkboxes = document.querySelectorAll('input[name="jenisIbadah[]"]');
        let checkedOne = false;

        // Cek apakah ada checkbox yang dipilih
        checkboxes.forEach((checkbox) => {
            if (checkbox.checked) {
                checkedOne = true;
            }
        });

        if (!checkedOne) {
            e.preventDefault(); // Mencegah pengiriman form jika tidak ada yang dipilih
            document.getElementById('checkboxError').style.display = 'block'; // Tampilkan pesan error
        }
    });
</script>