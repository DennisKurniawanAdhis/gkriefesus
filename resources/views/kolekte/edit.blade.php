@extends('layouts.appUang')   
@section('title', 'Edit Kolekte')  
@section('contents') 
<div class="container">     
    <form action="{{ route('kolekte.update', $kolekte->kasID) }}" method="POST">         
        @csrf         
        @method('PUT')
                
        <div class="row mb-3">             
            <div class="col-md-3">                 
                <label for="dataIbadahID" class="form-label">Nama Ibadah</label>             
            </div>             
            <div class="col-md-4">                 
                <select name="dataIbadahID" class="form-select" id="dataIbadahID" required>                     
                    @foreach ($ibadah as $p)                         
                        <option value="{{ $p->dataIbadahID }}" 
                            {{ $kolekte->dataIbadahID == old('dataIbadahID', $p->dataIbadahID) ? 'selected' : '' }}>
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
                <input type="text" name="jumlahUang" class="form-control @error('jumlahUang') is-invalid @enderror" id="jumlahUang" placeholder="Jumlah Uang" oninput="formatRupiah(this)" value="{{ old('jumlahUang',$jumlahUangFormatted) }}" required>
            </div>
            @error('jumlahUang')
            <div class="alert alert-warning" role="alert">
                <span class="font-medium">{{ $message }}</span>
            </div>
        @enderror
        </div>                     

        <div class="d-flex align-items-center">             
            <button type="submit" class="btn btn-primary mr-3">Update</button>    
        </div>     
    </form> 
</div> 
@endsection