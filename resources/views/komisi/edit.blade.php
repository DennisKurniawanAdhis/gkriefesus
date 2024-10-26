@extends('layouts.appAgt')

@section('title', 'Form Komisi')

@section('contents')
<div class="container">
    <form action="{{ route('komisi.update', $komisi->komisiID) }}" method="POST">
        @csrf
        @method('PUT')
        
        <!-- ID Komisi -->
        <div class="mb-3">
            <label for="komisiID" class="form-label">ID Komisi</label>
            <input type="text" name="komisiID" class="form-control" id="komisiID" placeholder="ID Komisi" value="{{ $komisi->komisiID }}" readonly>
        </div>

        <!-- Nama Komisi -->
        <div class="mb-3">
            <label for="namaKomisi" class="form-label">Nama Komisi</label>
            <input type="text" name="namaKomisi" class="form-control" id="namaKomisi" placeholder="Nama Komisi" value="{{ $komisi->namaKomisi }}" required>
        </div>

        <!-- Dropdown untuk Ketua -->
   
        <!-- Dropdown untuk Ketua -->
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="ketua" class="form-label">Ketua</label>
            </div>
            <div class="col-md-4">
                <select name="ketua" class="form-select select-jabatan" id="ketua" required>
                    <option value="">Pilih Ketua</option>
                    @foreach ($anggota as $a)
                        <option value="{{ $a->anggotaID }}" 
                            {{ (isset($ketuaTerpilih) && $ketuaTerpilih->anggotaID == $a->anggotaID) ? 'selected' : '' }}>
                            {{ $a->namaDepanAnggota }} {{ $a->namaBelakangAnggota }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>


        
        

        <!-- Dropdown untuk Wakil Ketua -->
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="wakil_ketua" class="form-label">Wakil Ketua</label>
            </div>
            <div class="col-md-4">
                <select name="wakil_ketua" class="form-select select-jabatan" id="wakil_ketua" required>
                    <option value="">Pilih Wakil Ketua</option>
                    @foreach ($anggota as $a)
                        <option value="{{ $a->anggotaID }}" 
                            {{ (isset($wakilTerpilih) && $wakilTerpilih->anggotaID == $a->anggotaID) ? 'selected' : '' }}>
                            {{ $a->namaDepanAnggota }} {{ $a->namaBelakangAnggota }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <label for="bendahara" class="form-label">Bendahara</label>
            </div>
            <div class="col-md-4">
                <select name="bendahara" class="form-select select-jabatan" id="bendahara" required>
                    <option value="">Pilih Bendahara</option>
                    @foreach ($anggota as $a)
                        <option value="{{ $a->anggotaID }}" 
                            {{ (isset($bendaharaTerpilih) && $bendaharaTerpilih->anggotaID == $a->anggotaID) ? 'selected' : '' }}>
                            {{ $a->namaDepanAnggota }} {{ $a->namaBelakangAnggota }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="row mb-3">
            <div class="col-md-3">
                <label for="sekretaris" class="form-label">Sekretaris</label>
            </div>
            <div class="col-md-4">
                <select name="sekretaris" class="form-select select-jabatan" id="sekretaris" required>
                    <option value="">Pilih Sekretaris</option>
                    @foreach ($anggota as $a)
                        <option value="{{ $a->anggotaID }}" 
                            {{ (isset($sekretarisTerpilih) && $sekretarisTerpilih->anggotaID == $a->anggotaID) ? 'selected' : '' }}>
                            {{ $a->namaDepanAnggota }} {{ $a->namaBelakangAnggota }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>


        <!-- Deskripsi Komisi -->
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <input type="text" name="deskripsi" class="form-control" id="deskripsi" placeholder="Deskripsi Komisi" value="{{ $komisi->deskripsi }}" required>
        </div>

        <!-- Tombol Save dan Cancel -->
        <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-primary mr-3">Save</button>
        </div>
    </form>
</div>
@endsection

<!-- Script untuk mengelola dropdown -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectElements = document.querySelectorAll('.select-jabatan');

        selectElements.forEach(select => {
            select.addEventListener('change', function() {
                updateDropdowns();
            });
        });

        function updateDropdowns() {
            // Ambil semua anggota yang sudah dipilih
            let selectedValues = [];
            selectElements.forEach(select => {
                if (select.value) {
                    selectedValues.push(select.value);
                }
            });

            // Sembunyikan anggota yang sudah dipilih dari dropdown lainnya
            selectElements.forEach(select => {
                const options = select.querySelectorAll('option');
                options.forEach(option => {
                    if (selectedValues.includes(option.value) && option.value !== select.value) {
                        option.style.display = 'none'; // Sembunyikan opsi jika sudah dipilih
                    } else {
                        option.style.display = ''; // Tampilkan opsi jika belum dipilih
                    }
                });
            });
        }

        // Update dropdown saat halaman pertama kali dimuat
        updateDropdowns();
    });
</script>
