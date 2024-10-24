@extends('layouts.appAgt')
  
@section('title', 'Show Pernikahan')
  
@section('contents')
    <h1 class="mb-0">Detail Calon Baptis</h1>
    
    <div class="container">
        <div class="mb-3 row">
            <label for="baptisID" class="col-sm-3 col-form-label">ID</label>
            <div class="col-sm-9">
                <input type="text" name="baptisID" class="form-control" id="baptisID" value="{{ $baptis->baptisID }}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="anggotaID" class="col-sm-3 col-form-label">Nama Anggota</label>
            <div class="col-sm-9">
                <input type="text" name="anggotaID" class="form-control" id="anggotaID" value="{{ $baptis->anggota->namaDepanAnggota }} {{ $baptis->anggota->namaBelakangAnggota }}" readonly>
            </div>
        </div>
        
        <div class="mb-3 row">
            <label for="pendetaID" class="col-sm-3 col-form-label">Nama Pendeta</label>
            <div class="col-sm-9">
                <input type="text" name="pendetaID" class="form-control" id="pendetaID" value="{{ $baptis->pendeta->namaDepanPendeta }} {{ $baptis->pendeta->namaBelakangPendeta }}" readonly>
            </div>
        </div>
        
        <div class="mb-3 row">
            <label for="namaAyah" class="col-sm-3 col-form-label">Nama Ayah</label>
            <div class="col-sm-9">
                <input type="text" name="namaAyah" class="form-control" id="namaAyah" value="{{ $baptis->namaAyah }}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="namaIbu" class="col-sm-3 col-form-label">Nama Ibu</label>
            <div class="col-sm-9">
                <input type="text" name="namaIbu" class="form-control" id="namaIbu" value="{{ $baptis->namaIbu }}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="tanggalBaptis" class="col-sm-3 col-form-label">Tanggal Baptis</label>
            <div class="col-sm-9">
                <input type="text" name="tanggalBaptis" class="form-control" id="tanggalBaptis" value="{{ $baptis->formatted_tanggal_baptis }}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
            <div class="col-sm-9">
                <textarea name="alamat" class="form-control" id="alamat" rows="3" readonly>{{ $alamat->namaJalan }}, RT/RW {{ $alamat->RT }}/{{ $alamat->RW }}, Kel. {{ $alamat->kelurahan }}, Kec. {{ $alamat->kecamatan }}, {{ $alamat->kota }}, {{ $alamat->provinsi }}, {{ $alamat->kodePos }}</textarea>

            </div>
        </div>
    </div>
@endsection
