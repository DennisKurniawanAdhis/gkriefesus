@extends('layouts.appUang')
  
@section('title', 'Form Sumbangan')
  
@section('contents')
<div class="container">
    <form action="{{ route('sumbangan.update', $sumbangan->kasID) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="namaPenyumbang" class="form-label">Nama Penyumbang</label>
            <input type="text" name="namaPenyumbang" class="form-control" id="namaPenyumbang" placeholder="namaPenyumbang" value="{{ $sumbangan->namaPenyumbang }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal Sumbangan</label>
            <input type="date" name="tanggal" class="form-control" id="tanggal" placeholder="DD/MM/YYYY" value="{{ $sumbangan->tanggal }}" required>
        </div>
        
<div class="mb-3">
    <label for="jumlahUang" class="form-label">Jumlah Uang</label>
    <div class="input-group">
        <span class="input-group-text">Rp.</span>
        <input type="number" name="jumlahUang" class="form-control" id="jumlahUang" placeholder="Jumlah Uang" oninput="formatRupiah(this)" value="{{ $jumlahUangFormatted }}" required>
    </div>
</div>

<div class="mb-3">
    <label for="deskripsi" class="form-label">Deskripsi</label>
    <input type="text" name="deskripsi" class="form-control" id="deskripsi" placeholder="Deskripsi" value="{{ $sumbangan->deskripsi }}">
</div>


        <!-- Tombol Save dan Cancel -->
        <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-primary mr-3">Save</button>
        </div>
    </form>
</div>
@endsection
