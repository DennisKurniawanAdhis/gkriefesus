@extends('layouts.appUang')
  
@section('title', 'Show Kolekte')
  
@section('contents')
    <h1 class="mb-0">Detail Kolekte</h1>


    <div class="container">
        
        <div class="mb-3 row">
            <label for="ibadahID" class="col-sm-3 col-form-label">Nama Ibadah</label>
            <div class="col-sm-9">
                <input type="text" name="ibadahID" class="form-control" id="ibadahID" value="{{ $kolekte->jenisIbadah->namaIbadah }} " readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="tanggal" class="col-sm-3 col-form-label">Tanggal Perpuluhan </label>
            <div class="col-sm-9">
                <input type="text" name="tanggal" class="form-control" id="tanggal" value="{{ $kolekte->formatted_tanggal}}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="jumlahUang" class="col-sm-3 col-form-label">Jumlah Uang</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <span class="input-group-text bg-white">Rp.</span> <!-- Menambahkan kelas bg-white -->
                    <input type="text" name="jumlahUang" class="form-control" id="jumlahUang" value="{{ number_format($kolekte->jumlahUang, 0, '', '.') }}" readonly>
                </div>
            </div>
        </div>
        
        
        

    </div> 
    
@endsection
