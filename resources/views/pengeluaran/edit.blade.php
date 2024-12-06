@extends('layouts.appUang') 

@section('title', 'Edit Pengeluaran')

@section('contents')
<div class="container">
    <form action="{{ route('pengeluaran.update', $pengeluaran->pengeluaranID) }}" method="POST">
        @csrf
        @method('PUT') <!-- Menambahkan metode PUT untuk pembaruan -->
        
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="ibadahID" class="form-label">Jenis Pengeluaran</label>
            </div>
            <div class="col-md-4">
                <select name="ibadahID" class="form-select" id="ibadahID" required>
                    <option value="">Pilih Jenis Pengeluaran</option>
                    @foreach ($ibadah as $p)
                        <option value="{{ $p->ibadahID }}" 
                            {{ old('ibadahID', $pengeluaran->ibadahID) === $p->ibadahID ? 'selected' : '' }}>
                            Ibadah {{ $p->namaIbadah }} 
                        </option>
                    @endforeach
                    <option value="kas" {{ old('ibadahID', $pengeluaran->ibadahID) === 'kas' ? 'selected' : '' }}>Kas</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal Pengeluaran</label>
            <input type="date" name="tanggal" class="form-control" id="tanggal" placeholder="DD/MM/YYYY" value="{{ old('tanggal',$tanggalFormatted) }}" required>
        </div>
        
        <div class="mb-3">
            <label for="jumlahUang" class="form-label">Jumlah Uang</label>
            <div class="input-group">
                <span class="input-group-text">Rp.</span>
                <input type="text" name="jumlahUang" class="form-control @error('jumlahUang') is-invalid @enderror" id="jumlahUang" placeholder="Jumlah Uang" oninput="formatRupiah(this)" value="{{ old('jumlahUang',$jumlahUangFormatted) }}" required>
            </div>
            @error('jumlahUang')
            <div class="alert alert-warning" role="alert">
                <span class="font-medium">{{ $message }}</span>
            </div>
        @enderror
        </div>
        
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <input type="text" name="deskripsi" class="form-control" id="deskripsi" placeholder="Deskripsi" value="{{ old('deskripsi',$pengeluaran->deskripsi) }}" required>
        </div>

        <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-primary mr-3">Update</button>
        </div>
    </form>
</div>
@endsection
