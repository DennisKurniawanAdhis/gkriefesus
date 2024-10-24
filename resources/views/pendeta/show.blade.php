@extends('layouts.appAgt')
  
@section('title', 'Show Pendeta')
  
@section('contents')
    <h1 class="mb-0">Detail Pendeta</h1>
    

    <div class="container">
        <div class="mb-3 row">
            <label for="pendetaID" class="col-sm-3 col-form-label">ID</label>
            <div class="col-sm-9">
                <input type="text" name="pendetaID" class="form-control" id="pendetaID" value="{{ $pendeta->pendetaID }}" readonly>
            </div>
        </div>
        
        <div class="mb-3 row">
            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-9">
                <input type="text" name="nama" class="form-control" id="nama" value="{{ $pendeta->namaDepanPendeta }} {{ $pendeta->namaBelakangPendeta }}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="tempat" class="col-sm-3 col-form-label">Tempat / tanggal lahir</label>
            <div class="col-sm-9">
                <input type="text" name="tempat" class="form-control" id="tempat" value="{{ $pendeta->tempatLahir }}, {{ $pendeta->formatted_tanggal_lahir }}" readonly>
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
                <input type="text" name="telp" class="form-control" id="telp" value="{{ $pendeta->noTelp }}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="jenisKelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-9">
                <input type="text" name="jenisKelamin" class="form-control" id="telp" value="{{ $pendeta->jenisKelamin }}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="statusKawin" class="col-sm-3 col-form-label">Status Kawin</label>
            <div class="col-sm-9">
                <input type="text" name="statusKawin" class="form-control" id="telp" value="{{ $pendeta->statusKawin }}" readonly>
            </div>
        </div>

      

        <div class="mb-3 row">
            <label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan</label>
            <div class="col-sm-9">
                <input type="text" name="pekerjaan" class="form-control" id="pekerjaan" value="{{ $pendeta->pekerjaan }}" readonly>
            </div>
        </div>


        <div class="mb-3 row">
            <label for="gelar" class="col-sm-3 col-form-label">Gelar</label>
            <div class="col-sm-9">
                <input type="text" name="gelar" class="form-control" id="gelar" value="{{ $pendeta->gelar }}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="nik" class="col-sm-3 col-form-label">NIK</label>
            <div class="col-sm-9">
                <input type="text" name="nik" class="form-control" id="nik" value="{{ $pendeta->NIK }}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="kk" class="col-sm-3 col-form-label">No KK</label>
            <div class="col-sm-9">
                <input type="text" name="kk" class="form-control" id="kk" value="{{ $pendeta->noKK }}" readonly>
            </div>
        </div>
        
    </div>

    <div class="text-center my-4">
        <hr>
        <span class="label-divider">Pelayanan Pendeta</span>
        <hr>
        @foreach ($jenisIbadah as $ibadah)
        <div class="mb-3 row">
            <label for="banyakIbadah" class="col-sm-3 col-form-label">Ibadah {{ $ibadah->namaIbadah }}</label>
            <div class="col-sm-9 d-flex align-items-center">
                <input type="text" name="banyakIbadah" class="form-control w-25 me-2" value="{{ $ibadah->ibadah_count }}" readonly>
                <label class="ml-2 mt-2">Kali</label>
            </div>
        </div>
    @endforeach

   
        <div class="mb-3 row">
            <label for="pernikahan" class="col-sm-3 col-form-label">Pernikahan</label>
            <div class="col-sm-9 d-flex align-items-center">
                <input type="text" name="pernikahan" class="form-control w-25 me-2" value="{{ $jumlahPernikahan }}" readonly>
                <label class="ml-2 mt-2">Kali</label>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="baptis" class="col-sm-3 col-form-label">Baptis</label>
            <div class="col-sm-9 d-flex align-items-center">
                <input type="text" name="baptis" class="form-control w-25 me-2" value="{{ $jumlahBaptis  }}" readonly>
                <label class="ml-2 mt-2">Kali</label>
            </div>
        </div>
    
    </div>

    
    
    
@endsection