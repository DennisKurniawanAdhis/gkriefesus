@extends('layouts.appAgt')
  
@section('title', 'Show Keahlian')
  
@section('contents')
    <h1 class="mb-0">Detail Keahlian</h1>
    

    <div class="container">
        <div class="mb-3 row">
            <label for="keahlianID" class="col-sm-3 col-form-label">ID</label>
            <div class="col-sm-9">
                <input type="text" name="keahlianID" class="form-control" id="keahlianID" value="{{ $keahlian->keahlianID }}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="namaKeahlian" class="col-sm-3 col-form-label">Nama Keahlian</label>
            <div class="col-sm-9">
                <input type="text" name="namaKeahlian" class="form-control" id="namaKeahlian" value="{{ $keahlian->namaKeahlian }}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
            <div class="col-sm-9">
                <input type="text" name="deskripsi" class="form-control" id="deskripsi" value="{{ $keahlian->deskripsi }}" readonly>
            </div>
        </div>
        
    </div>
    
    
@endsection