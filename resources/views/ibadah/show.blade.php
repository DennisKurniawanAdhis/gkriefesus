@extends('layouts.appAgt')
  
@section('title', 'Show Ibadah')
  
@section('contents')
    <h1 class="mb-0">Detail Ibadah</h1>


    <div class="container">
         
        <div class="mb-3 row">
            <label for="dataIbadahID" class="col-sm-3 col-form-label">Nama Ibadah</label>
            <div class="col-sm-9">
                <input type="text" name="dataIbadahID" class="form-control" id="dataIbadahID" value="{{ $dataIbadah->jenisIbadah->namaIbadah }} " readonly>
            </div>
        </div>
        
        <div class="mb-3 row">
            <label for="pendetaID" class="col-sm-3 col-form-label">Nama Pendeta</label>
            <div class="col-sm-9">
                <input type="text" name="pendetaID" class="form-control" id="pendetaID" value="{{ $dataIbadah->pendeta->namaDepanPendeta }} {{ $dataIbadah->pendeta->namaBelakangPendeta }}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="tanggalIbadah" class="col-sm-3 col-form-label">Tanggal Ibadah</label>
            <div class="col-sm-9">
                <input type="text" name="tanggalIbadah" class="form-control" id="tanggalIbadah" value="{{ $dataIbadah->formatted_tanggal_Ibadah }}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
            <div class="col-sm-9">
                <input type="text" name="deskripsi" class="form-control" id="deskripsi" value="{{ $dataIbadah->deskripsi }} " readonly>
            </div>
        </div>

    </div> 
    
@endsection
