@extends('layouts.appAgt')
  
@section('title', 'Show Pernikahan')
  
@section('contents')
    <h1 class="mb-0">Detail Pernikahan</h1>
    
    <div class="container">
        <div class="mb-3 row">
            <label for="pernikahanID" class="col-sm-3 col-form-label">ID</label>
            <div class="col-sm-9">
                <input type="text" name="pernikahanID" class="form-control" id="pernikahanID" value="{{ $pernikahan->pernikahanID }}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="anggotaID_suami" class="col-sm-3 col-form-label">Nama Pasangan Pria</label>
            <div class="col-sm-9">
                <input type="text" name="anggotaID_suami" class="form-control" id="anggotaID_suami" value="{{ $pernikahan->suami->namaDepanAnggota }} {{ $pernikahan->suami->namaBelakangAnggota }}" readonly>
            </div>
        </div>
        
        <div class="mb-3 row">
            <label for="anggotaID_istri" class="col-sm-3 col-form-label">Nama Pasangan Wanita</label>
            <div class="col-sm-9">
                <input type="text" name="anggotaID_istri" class="form-control" id="anggotaID_istri" value="{{ $pernikahan->istri->namaDepanAnggota }} {{ $pernikahan->istri->namaBelakangAnggota }}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="pendetaID" class="col-sm-3 col-form-label">Nama Pendeta</label>
            <div class="col-sm-9">
                <input type="text" name="pendetaID" class="form-control" id="pendetaID" value="{{ $pernikahan->pendeta->namaDepanPendeta }} {{ $pernikahan->pendeta->namaBelakangPendeta }}" readonly>
            </div>
        </div>
        
        <div class="mb-3 row">
            <label for="tanggalPernikahan" class="col-sm-3 col-form-label">Tanggal Pernikahan</label>
            <div class="col-sm-9">
                <input type="text" name="tanggalPernikahan" class="form-control" id="tanggalPernikahan" value="{{ $pernikahan->formatted_tanggal_pernikahan }}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="namaOrangKua" class="col-sm-3 col-form-label">Nama Pihak Kua</label>
            <div class="col-sm-9">
                <input type="text" name="namaOrangKua" class="form-control" id="namaOrangKua" value="{{ $pernikahan->namaOrangKua }}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="noStbld" class="col-sm-3 col-form-label">Nomor Stbld</label>
            <div class="col-sm-9">
                <input type="text" name="noStbld" class="form-control" id="noStbld" value="{{ $pernikahan->noStbld }}" readonly>
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
