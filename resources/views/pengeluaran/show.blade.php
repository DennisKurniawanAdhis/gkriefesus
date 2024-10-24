@extends('layouts.appUang')
  
@section('title', 'Show Pengeluaran')
  
@section('contents')
    <h1 class="mb-0">Detail Pengeluaran</h1>


    <div class="container">
        
        <div class="mb-3 row">
            <label for="jenisPengeluaran" class="col-sm-3 col-form-label">Jenis Pengeluaran</label>
            <div class="col-sm-9">
                <input type="text" name="jenisPengeluaran" class="form-control" id="jenisPengeluaran"  value="{{ $pengeluaran->jenisPengeluaran === 'kas' ? 'Kas' : 'Ibadah ' . ($pengeluaran->jenisIbadah->namaIbadah ?? 'Tidak Diketahui') }}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="tanggal" class="col-sm-3 col-form-label">Tanggal Pengeluaran </label>
            <div class="col-sm-9">
                <input type="text" name="tanggal" class="form-control" id="tanggal" value="{{ $pengeluaran->formatted_tanggal}}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="jumlahUang" class="col-sm-3 col-form-label">Jumlah Uang</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <span class="input-group-text bg-white">Rp.</span> <!-- Menambahkan kelas bg-white -->
                    <input type="text" name="jumlahUang" class="form-control" id="jumlahUang" value="{{ number_format($pengeluaran->jumlahUang, 0, '', '.') }}" readonly>
                </div>
            </div>
        </div>
        
        <div class="mb-3 row">
            <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
            <div class="col-sm-9">
                <input type="text" name="deskripsi" class="form-control" id="deskripsi" value="{{ $pengeluaran->deskripsi }} " readonly>
            </div>
        </div>
        
        

    </div> 
    
@endsection
