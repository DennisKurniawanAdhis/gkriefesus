@extends('layouts.appUang')
  
@section('title', 'Form Perpuluhan')
  
@section('contents')
<div class="container">
    <form action="{{ route('perpuluhan.store') }}" method="POST">
        @csrf
      <!-- ID -->
     
        <div class="row mb-3">
            <!-- Dropdown untuk Pria -->
            <div class="col-md-3">
                <label for="anggotaID" class="form-label">Nama Anggota</label>
            </div>
            <div class="col-md-4">
                <select name="anggotaID" class="form-select" id="anggotaID" required>
                    @foreach ($anggota as $p)
                        <option value="{{ $p->anggotaID }}" {{ old('anggotaID') == $p->anggotaID ? 'selected' : '' }}>
                            {{ $p->namaDepanAnggota }} {{ $p->namaBelakangAnggota }} 
                        </option>
                    @endforeach
                </select>
            </div>
        </div>



    <div class="mb-3">
        <label for="tanggal" class="form-label">Tanggal Perpuluhan</label>
        <input type="date" name="tanggal" class="form-control" id="tanggal" placeholder="DD/MM/YYYY" value="{{ old('tanggal') }}" required>
    </div>
    
    <div class="mb-3">
        <label for="jumlahUang" class="form-label">Jumlah Uang</label>
        <div class="input-group">
            <span class="input-group-text">Rp.</span>
            <input type="number" name="jumlahUang" class="form-control @error('jumlahUang') is-invalid @enderror" id="jumlahUang" placeholder="Jumlah Uang" oninput="formatRupiah(this)" value="{{ old('jumlahUang') }}" required>
        </div>
        @error('jumlahUang')
        <div class="alert alert-warning" role="alert">
            <span class="font-medium">{{ $message }}</span>
        </div>
    @enderror
    </div>
    
    

      <!-- Tombol Save dan Cancel -->
      <div class="d-flex align-items-center">
        <button type="submit" class="btn btn-primary mr-3">Save</button>
    </div>
  </form>
</div>
@endsection

