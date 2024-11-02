@extends('layouts.appUang')

@section('title', 'Dashboard Kas')

@section('contents')
<div class="container mt-5">
    <!-- Filter Section -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Filter Berdasarkan Tanggal</h5>
        </div>
        <div class="card-body">
            <form id="filterForm" method="GET" action="{{ route('DashboardKas.index') }}">
                <div class="row">
                    <div class="col-md-5">
                        <label for="tanggalAwal" class="form-label">Tanggal Awal</label>
                        <input type="date" class="form-control" id="tanggalAwal" name="tanggalAwal" 
                               value="{{ $tanggalAwal ? $tanggalAwal->format('Y-m-d') : '' }}">
                    </div>
                    <div class="col-md-5">
                        <label for="tanggalAkhir" class="form-label">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="tanggalAkhir" name="tanggalAkhir" 
                               value="{{ $tanggalAkhir ? $tanggalAkhir->format('Y-m-d') : '' }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Summary Cards Section -->
    <div class="row mb-4">
        <!-- Kas Umum Card -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Total Kas Umum</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Perpuluhan</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control text-end" value="{{ number_format($totalPerpuluhan, 0, '', '.') }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Sumbangan</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control text-end" value="{{ number_format($totalSumbangan, 0, '', '.') }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 col-form-label">Total Kas</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control text-end fw-bold" value="{{ number_format($totalPengeluaranKas, 0, '', '.') }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pengeluaran Kas Card -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">Total Pengeluaran Kas</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <label class="col-sm-4 col-form-label">Pengeluaran</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control text-end" value="{{ number_format($pengeluaranKas, 0, '', '.') }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kas Per Ibadah Section -->
    <div class="card">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Kas Per Ibadah</h5>
        </div>
        <div class="card-body">
            @foreach ($kasPerIbadah as $ibadahID => $data)
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="mb-0">{{ $data['namaIbadah'] }}</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <label class="col-sm-3 col-form-label">Total Kolekte</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control text-end" value="{{ number_format($data['totalKolekte'], 0, '', '.') }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-3 col-form-label">Total Pengeluaran</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control text-end text-danger" value="{{ number_format($data['totalPengeluaran'], 0, '', '.') }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Saldo Akhir</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control text-end fw-bold {{ $data['saldoAkhir'] >= 0 ? 'text-success' : 'text-danger' }}" 
                                       value="{{ number_format($data['saldoAkhir'], 0, '', '.') }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Auto-submit form when dates change
    document.getElementById('tanggalAwal').addEventListener('change', function() {
        if (document.getElementById('tanggalAkhir').value) {
            document.getElementById('filterForm').submit();
        }
    });
    
    document.getElementById('tanggalAkhir').addEventListener('change', function() {
        if (document.getElementById('tanggalAwal').value) {
            document.getElementById('filterForm').submit();
        }
    });
</script>
@endpush
@endsection