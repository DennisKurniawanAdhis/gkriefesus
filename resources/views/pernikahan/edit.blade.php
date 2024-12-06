@extends('layouts.appAgt')
  
@section('title', 'Form Pernikahan')
  
@section('contents')
<div class="container">
    <form action="{{ route('pernikahan.update', $pernikahan->pernikahanID) }}" method="POST">
        @csrf
        @method('PUT')
      <!-- ID -->
      <div class="mb-3">
          <label for="pernikahanID" class="form-label">ID</label>
          <input type="text" name="pernikahanID" class="form-control" id="pernikahanID" placeholder="ID Pernikahan" value="{{ old('pernikahanID',$pernikahan->pernikahanID) }}" readonly>
      </div>

      
        <div class="row mb-3">
            <!-- Dropdown untuk Pria (Suami) -->
            <div class="col-md-3">
                <label for="anggotaID_suami" class="form-label">Nama Pasangan Pria</label>
            </div>
            <div class="col-md-4">
                <select name="anggotaID_suami" class="form-select" id="anggotaID_suami" required>
                    <option value="">Pilih Pasangan Pria</option>
                    @foreach ($pria as $p)
                        <option value="{{ $p->anggotaID }}" 
                            {{ old('anggotaID_suami', $pernikahan->anggotaID_suami) == $p->anggotaID ? 'selected' : '' }}>
                            {{ $p->namaDepanAnggota }} {{ $p->namaBelakangAnggota }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="row mb-3">
            <!-- Dropdown untuk Wanita (Istri) -->
            <div class="col-md-3">
                <label for="anggotaID_istri" class="form-label">Nama Pasangan Wanita</label>
            </div>
            <div class="col-md-4">
                <select name="anggotaID_istri" class="form-select" id="anggotaID_istri" required>
                    <option value="">Pilih Pasangan Wanita</option>
                    @foreach ($wanita as $w)
                        <option value="{{ $w->anggotaID }}" 
                            {{ old('anggotaID_istri', $pernikahan->anggotaID_istri) == $w->anggotaID ? 'selected' : '' }}>
                            {{ $w->namaDepanAnggota }} {{ $w->namaBelakangAnggota }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="row mb-3">
            <!-- Dropdown untuk Pendeta -->
            <div class="col-md-3">
                <label for="pendetaID" class="form-label">Pendeta</label>
            </div>
            <div class="col-md-4">
                <select name="pendetaID" class="form-select" id="pendetaID" required>
                    <option value="">Pilih Pendeta</option>
                    @foreach ($pendeta as $p)
                        <option value="{{ $p->pendetaID }}" 
                            {{ old('pendetaID', $pendetaTerpilih ? $pendetaTerpilih->pendetaID : null) == $p->pendetaID ? 'selected' : '' }}>
                            {{ $p->namaDepanPendeta }} {{ $p->namaBelakangPendeta }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>


    <div class="mb-3">
        <label for="tanggalPernikahan" class="form-label">Tanggal Pernikahan</label>
        <input type="date" name="tanggalPernikahan" class="form-control" id="tanggalPernikahan" placeholder="DD/MM/YYYY" value="{{ old('tanggalPernikahan',$pernikahan->tanggalPernikahan) }}" required>
    </div>
    
    <div class="mb-3">
        <label for="namaOrangKua" class="form-label">Nama Pihak Kua</label>
        <input type="text" name="namaOrangKua" class="form-control" id="namaOrangKua" placeholder="Nama Pihak Kua" value="{{ old('namaOrangKua',$pernikahan->namaOrangKua) }}" required>
    </div>
    
    <div class="mb-3">
        <label for="noStbld" class="form-label">Nomor Stbld</label>
        <input type="text" name="noStbld" class="form-control" id="noStbld" placeholder="Nomor Stbld" value="{{ old('noStbld',$pernikahan->noStbld) }}" required>
    </div>

      <!-- Nama Depan dan Belakang -->
    

      <!-- Tempat dan Tgl Lahir -->


      <!-- Alamat -->
      <div class="mb-3">
        <label for="namaJalan" class="form-label">Alamat</label>
        <input type="text" name="namaJalan" class="form-control" id="namaJalan" placeholder="Nama Jalan" value="{{ old('namaJalan',$alamatPernikahan->namaJalan) }}" required>
    </div>

    <!-- RT, RW, Kode Pos -->
    <div class="row">
        <div class="col-md-2 mb-3">
            <input type="number" name="RT" class="form-control @error('RT') is-invalid @enderror" id="RT" placeholder="RT" value="{{ old('RT',$alamatPernikahan->RT) }}" required>
            @error('RT')
            <div class="alert alert-warning" role="alert">
                <span class="font-medium">{{ $message }}</span>
            </div>
        @enderror
        </div>
        <div class="col-md-2 mb-3">
            <input type="number" name="RW" class="form-control @error('RW') is-invalid @enderror" id="RW" placeholder="RW" value="{{ old('RW',$alamatPernikahan->RW) }}" required>
            @error('RW')
            <div class="alert alert-warning" role="alert">
                <span class="font-medium">{{ $message }}</span>
            </div>
        @enderror
        </div>
        <div class="col-md-4 mb-3">
            <input type="number" name="kodePos" class="form-control @error('kodePos') is-invalid @enderror" id="kodePos" placeholder="Kode Pos" value="{{ old('kodePos',$alamatPernikahan->kodePos) }}" required>
        </div>
        @error('kodePos')
        <div class="alert alert-warning" role="alert">
            <span class="font-medium">{{ $message }}</span>
        </div>
    @enderror
    </div>

    <!-- Kelurahan, Kecamatan, Kota, Provinsi -->
    <div class="row">
        <div class="col-md-3 mb-3">
            <input type="text" name="kelurahan" class="form-control" id="kelurahan" placeholder="Kelurahan" value="{{ old('kelurahan',$alamatPernikahan->kelurahan) }}" required>
        </div>
        <div class="col-md-3 mb-3">
            <input type="text" name="kecamatan" class="form-control" id="kecamatan" placeholder="Kecamatan" value="{{ old('kecamatan',$alamatPernikahan->kecamatan) }}" required>
        </div>
        <div class="col-md-3 mb-3">
            <input type="text" name="kota" class="form-control" id="kota" placeholder="Kota" value="{{ old('kota',$alamatPernikahan->kota) }}" required>
        </div>
        <div class="col-md-3 mb-3">
            <input type="text" name="provinsi" class="form-control" id="provinsi" placeholder="Provinsi" value="{{ old('provinsi',$alamatPernikahan->provinsi) }}" required>
        </div>
    </div>

    

      <!-- Tombol Save dan Cancel -->
      <div class="d-flex align-items-center">
        <button type="submit" class="btn btn-primary mr-3">Save</button>
    </div>
  </form>
</div>
@endsection