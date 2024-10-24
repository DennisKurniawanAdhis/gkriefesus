@extends('layouts.appUang')
  
@section('title', 'Show Sumbangan')
  
@section('contents')
    <h1 class="mb-0">Detail Sumbangan</h1>


    <div class="container">
        
        <div class="mb-3 row">
            <label for="namaPenyumbang" class="col-sm-3 col-form-label">Nama Penyumbang</label>
            <div class="col-sm-9">
                <input type="text" name="namaPenyumbang" class="form-control" id="namaPenyumbang" value="{{ $sumbangan->namaPenyumbang }} " readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="tanggal" class="col-sm-3 col-form-label">Tanggal Sumbangan </label>
            <div class="col-sm-9">
                <input type="text" name="tanggal" class="form-control" id="tanggal" value="{{ $sumbangan->formatted_tanggal}}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="jumlahUang" class="col-sm-3 col-form-label">Jumlah Uang</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <span class="input-group-text bg-white">Rp.</span> <!-- Menambahkan kelas bg-white -->
                    <input type="text" name="jumlahUang" class="form-control" id="jumlahUang" value="{{ number_format($sumbangan->jumlahUang, 0, '', '.') }}" readonly>
                </div>
            </div>
        </div>
        
        <div class="mb-3 row">
            <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
            <div class="col-sm-9">
                <input type="text" name="deskripsi" class="form-control" id="deskripsi" value="{{ $sumbangan->deskripsi }} " readonly>
            </div>
        </div>
        

    </div> 
    
@endsection
