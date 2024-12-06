@extends('layouts.appAgt')
  
@section('title', 'Form Anggota')
  
@section('contents')
<div class="container">
    <form action="{{ route('anggota.store') }}" method="POST">
        @csrf
      <!-- ID -->
      {{-- <div class="mb-3">
          <label for="anggotaID" class="form-label">ID</label>
          <input type="text" name="anggotaID" class="form-control" id="anggotaID" placeholder="ID Anggota" required>
      </div> --}}

      <!-- Nama Depan dan Belakang -->
      <div class="row">
          <div class="col-md-6 mb-3">
              <label for="namaDepanAnggota" class="form-label">Nama Depan</label>
              <input type="text" name="namaDepanAnggota" class="form-control" id="namaDepanAnggota" placeholder="Nama Depan" value="{{ old('namaDepanAnggota') }}" required>
          </div>
          <div class="col-md-6 mb-3">
              <label for="namaBelakangAnggota" class="form-label">Nama Belakang</label>
              <input type="text" name="namaBelakangAnggota" class="form-control" id="namaBelakangAnggota" placeholder="Nama Belakang" value="{{ old('namaBelakangAnggota') }}" required>
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

      <script>
        document.getElementById('submitBtn').addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah form dari pengiriman otomatis
    
            const rt = document.getElementById('RT').value;
            const rw = document.getElementById('RW').value;
            const kodePos = document.getElementById('kodePos').value;
    
            // Validasi RT (harus 4 digit)
            if (!/^\d{4}$/.test(rt)) {
                alert('RT harus terdiri dari 4 angka.');
                return;
            }
    
            // Validasi RW (harus 4 digit)
            if (!/^\d{4}$/.test(rw)) {
                alert('RW harus terdiri dari 4 angka.');
                return;
            }
    
            // Validasi kodePos (harus 7 digit)
            if (!/^\d{7}$/.test(kodePos)) {
                alert('Kode Pos harus terdiri dari 7 angka.');
                return;
            }
    
            // Jika semua validasi lulus, kirim form
            // Misalnya: document.getElementById('yourFormId').submit();
            alert('Form valid, siap untuk dikirim!');
        });
    </script>

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


    <div class="mb-3">
        <label for="JenisIbadah" class="form-label">Jenis Ibadah</label>
        @if($jenisIbadah->isEmpty())
            <p>Belum ada data ibadah</p>
        @else
            @foreach ($jenisIbadah as $ibadah)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="jenisIbadah[]" id="{{ $ibadah->namaIbadah }}" value="{{ $ibadah->ibadahID }}" 
                        {{ in_array($ibadah->ibadahID, old('jenisIbadah', [])) ? 'checked' : '' }}>
                    
                    <label class="form-check-label" for="{{ $ibadah->namaIbadah }}">
                        {{ $ibadah->namaIbadah }}
                    </label>
                </div>
            @endforeach
        @endif
    </div>
    
    <div class="mb-3">
        <label for="Keahlian" class="form-label">Keahlian</label>
        @if($keahlian->isEmpty())
            <p>Belum ada data keahlian</p>
        @else
            @foreach ($keahlian as $ini)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="keahlian[]" value="{{ $ini->keahlianID }}" id="{{ $ini->namaKeahlian }}" 
                        {{ in_array($ini->keahlianID, old('keahlian', [])) ? 'checked' : '' }}>
                    
                    <label class="form-check-label" for="{{ $ini->namaKeahlian }}">
                        {{ $ini->namaKeahlian }}
                    </label>
                </div>
            @endforeach
        @endif
    </div>

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