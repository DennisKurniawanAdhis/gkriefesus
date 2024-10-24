@extends('layouts.appAgt')
  
@section('title', 'Show Komisi')
  
@section('contents')
    <h1 class="mb-0">Detail Komisi</h1>


    <div class="container">

          <div class="mb-3 row">
            <label for="komisiID" class="col-sm-3 col-form-label">ID Komisi</label>
            <div class="col-sm-9">
                <input type="text" name="komisiID" class="form-control" id="komisiID" value="{{ $komisi->komisiID ?? 'Tidak ada'}} " readonly>
            </div>
        </div>
         
        <div class="mb-3 row">
            <label for="namaKomisi" class="col-sm-3 col-form-label">Nama Komisi</label>
            <div class="col-sm-9">
                <input type="text" name="namaKomisi" class="form-control" id="namaKomisi" value="{{ $komisi->namaKomisi ?? 'Tidak ada'}} " readonly>
            </div>
        </div>
        
        <div class="mb-3 row">
            <label for="ketua" class="col-sm-3 col-form-label">Ketua</label>
            <div class="col-sm-9">
                <input type="text" name="ketua" class="form-control" id="ketua" value="{{ $ketua->namaDepanAnggota ?? 'Tidak'}} {{ $ketua->namaBelakangAnggota ?? 'ada'}}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="wakil_ketua" class="col-sm-3 col-form-label">Wakil Ketua</label>
            <div class="col-sm-9">
                <input type="text" name="wakil_ketua" class="form-control" id="wakil_ketua" value="{{ $wakilKetua->namaDepanAnggota ?? 'Tidak' }} {{ $wakilKetua->namaBelakangAnggota ?? 'ada' }}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="bendahara" class="col-sm-3 col-form-label">Bendahara</label>
            <div class="col-sm-9">
                <input type="text" name="bendahara" class="form-control" id="bendahara" value="{{ $bendahara->namaDepanAnggota ?? 'Tidak' }} {{ $bendahara->namaBelakangAnggota ?? 'ada'}}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="sekretaris" class="col-sm-3 col-form-label">Sekretaris</label>
            <div class="col-sm-9">
                <input type="text" name="sekretaris" class="form-control" id="sekretaris" value="{{ $sekretaris->namaDepanAnggota ?? 'Tidak' }} {{ $bendahara->namaBelakangAnggota ?? 'ada'}}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
            <div class="col-sm-9">
                <input type="text" name="deskripsi" class="form-control" id="deskripsi" value="{{ $komisi->deskripsi }} " readonly>
            </div>
        </div>

    </div> 
    
@endsection
