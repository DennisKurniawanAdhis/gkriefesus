@extends('layouts.appAgt')
  
@section('title', 'Show Anggota')
  
@section('contents')
    <h1 class="mb-0">Detail Anggota</h1>
    

    <div class="container">
        <div class="mb-3 row">
            <label for="anggotaID" class="col-sm-3 col-form-label">ID</label>
            <div class="col-sm-9">
                <input type="text" name="anggotaID" class="form-control" id="anggotaID" value="{{ $anggota->anggotaID }}" readonly>
            </div>
        </div>
        
        <div class="mb-3 row">
            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-9">
                <input type="text" name="nama" class="form-control" id="nama" value="{{ $anggota->namaDepanAnggota }} {{ $anggota->namaBelakangAnggota }}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="tempat" class="col-sm-3 col-form-label">Tempat / tanggal lahir</label>
            <div class="col-sm-9">
                <input type="text" name="tempat" class="form-control" id="tempat" value="{{ $anggota->tempatLahir }}, {{ $anggota->formatted_tanggal_lahir }}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
            <div class="col-sm-9">
                <textarea name="alamat" class="form-control" id="alamat" rows="3" readonly>{{ $alamat->namaJalan }}, RT/RW {{ $alamat->RT }}/{{ $alamat->RW }}, Kel. {{ $alamat->kelurahan }}, Kec. {{ $alamat->kecamatan }}, {{ $alamat->kota }}, {{ $alamat->provinsi }}, {{ $alamat->kodePos }}
                </textarea>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="telp" class="col-sm-3 col-form-label">Nomor Telepon</label>
            <div class="col-sm-9">
                <input type="text" name="telp" class="form-control" id="telp" value="{{ $anggota->noTelp }}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="jenisKelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-9">
                <input type="text" name="jenisKelamin" class="form-control" id="telp" value="{{ $anggota->jenisKelamin }}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="statusKawin" class="col-sm-3 col-form-label">Status Kawin</label>
            <div class="col-sm-9">
                <input type="text" name="statusKawin" class="form-control" id="telp" value="{{ $anggota->statusKawin }}" readonly>
            </div>
        </div>

      

        <div class="mb-3 row">
            <label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan</label>
            <div class="col-sm-9">
                <input type="text" name="pekerjaan" class="form-control" id="pekerjaan" value="{{ $anggota->pekerjaan }}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
            <div class="col-sm-9">
                <input type="text" name="jabatan" class="form-control" id="jabatan" 
                       value="{{ isset($anggota->komisi->namaKomisi) ? 'Komisi ' . $anggota->komisi->namaKomisi : '' }} ({{ $anggota->jabatan ?? 'Tidak ada' }})"readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="kawin" class="col-sm-3 col-form-label">Status Kawin</label>
            <div class="col-sm-9">
                <input type="text" name="kawin" class="form-control" id="kawin" value="{{ $anggota->statusKawin }}" readonly>
            </div>
        </div>

         <div class="mb-3 row">
            <label for="keahlian" class="col-sm-3 col-form-label">Keahlian</label>
            <div class="col-sm-9">
                <input type="text" name="keahlian" class="form-control" id="keahlian" 
                    value="{{ !empty($keahlian) ? $keahlian : 'Tidak ada' }}" readonly>
            </div>
        </div>
        
        <div class="mb-3 row">
            <label for="jenisIbadah" class="col-sm-3 col-form-label">Ibadah</label>
            <div class="col-sm-9">
                <input type="text" name="jenisIbadah" class="form-control" id="jenisIbadah" 
                    value="{{ !empty($jenisIbadah) ? $jenisIbadah : 'Tidak ada' }}" readonly>
            </div>
        </div>
        

        
        
        <div class="mb-3 row">
            <label for="nik" class="col-sm-3 col-form-label">NIK</label>
            <div class="col-sm-9">
                <input type="text" name="nik" class="form-control" id="nik" value="{{ $anggota->NIK }}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="kk" class="col-sm-3 col-form-label">No KK</label>
            <div class="col-sm-9">
                <input type="text" name="kk" class="form-control" id="kk" value="{{ $anggota->noKK }}" readonly>
            </div>
        </div>
        
    </div>
    
    
@endsection