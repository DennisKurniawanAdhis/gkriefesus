@extends('layouts.appUang')
  
@section('title', 'Form Kolekte')
  
@section('contents')
<div class="container">
    <form action="{{ route('kolekte.store') }}" method="POST">
        @csrf
      <!-- ID -->
     
        <div class="row mb-3">
            <!-- Dropdown untuk Pria -->
            <div class="col-md-3">
                <label for="dataIbadahID" class="form-label">Nama Ibadah</label>
            </div>
            <div class="col-md-4">
                <select name="dataIbadahID" class="form-select" id="dataIbadahID" required>
                    @foreach ($ibadah as $p)
                        <option value="{{ $p->dataIbadahID }}">
                            Ibadah {{ $p->jenisIbadah->namaIbadah }} - {{ $p->tanggalIbadah }} 
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

    <div class="mb-3">
        <label for="jumlahUang" class="form-label">Jumlah Uang</label>
        <div class="input-group">
            <span class="input-group-text">Rp.</span>
            <input type="number" name="jumlahUang" class="form-control" id="jumlahUang" placeholder="Jumlah Uang" oninput="formatRupiah(this)" required>
        </div>
    </div>
    
    

      <!-- Tombol Save dan Cancel -->
      <div class="d-flex align-items-center">
        <button type="submit" class="btn btn-primary mr-3">Save</button>
    </div>
  </form>
</div>
@endsection

