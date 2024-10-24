@extends('layouts.appUang')
  
@section('title', 'Show Perpuluhan')
  
@section('contents')
    <h1 class="mb-0">Detail Perpuluhan</h1>


    <div class="container">
        
        <div class="mb-3 row">
            <label for="anggotaID" class="col-sm-3 col-form-label">Nama Anggota</label>
            <div class="col-sm-9">
                <input type="text" name="anggotaID" class="form-control" id="anggotaID" value="{{ $perpuluhan->anggota->namaDepanAnggota }} {{ $perpuluhan->anggota->namaBelakangAnggota }}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="tanggal" class="col-sm-3 col-form-label">Tanggal Perpuluhan </label>
            <div class="col-sm-9">
                <input type="text" name="tanggal" class="form-control" id="tanggal" value="{{ $perpuluhan->formatted_tanggal}}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="jumlahUang" class="col-sm-3 col-form-label">Jumlah Uang</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <span class="input-group-text bg-white">Rp.</span> <!-- Menambahkan kelas bg-white -->
                    <input type="text" name="jumlahUang" class="form-control" id="jumlahUang" value="{{ number_format($perpuluhan->jumlahUang, 0, '', '.') }}" readonly>
                </div>
            </div>
        </div>
        
        
        

    </div> 
    
@endsection
