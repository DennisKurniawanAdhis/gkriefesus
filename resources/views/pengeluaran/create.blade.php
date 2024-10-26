@extends('layouts.appUang')

@section('title', 'Form Pengeluaran')

@section('contents')
<div class="container">
    <form action="{{ route('pengeluaran.store') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="ibadahID" class="form-label">Jenis Pengeluaran</label>
            </div>
            <div class="col-md-4">
                <select name="ibadahID" class="form-select" id="ibadahID" required>
                    <option value="">Pilih Jenis Pengeluaran</option>
                    @foreach ($ibadah as $p)
                        <option value="{{ $p->ibadahID }}">
                            Ibadah {{ $p->namaIbadah }} 
                        </option>
                    @endforeach
                    <option value="kas">Kas</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal Pengeluaran</label>
            <input type="date" name="tanggal" class="form-control" id="tanggal" placeholder="DD/MM/YYYY" required>
        </div>
        
        <div class="mb-3">
            <label for="jumlahUang" class="form-label">Jumlah Uang</label>
            <div class="input-group">
                <span class="input-group-text">Rp.</span>
                <input type="number" name="jumlahUang" class="form-control" id="jumlahUang" placeholder="Jumlah Uang" oninput="formatRupiah(this)" required>
            </div>
        </div>
        
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <input type="text" name="deskripsi" class="form-control" id="deskripsi" placeholder="Deskripsi" required>
        </div>

        <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-primary mr-3">Save</button>
        </div>
    </form>
</div>
@endsection
