@extends('layouts.app')

@section('page_title', 'Laporan Operasional')

@push('styles')
<style>
    @media print {
        .no-print {
            display: none !important;
        }
        .print-header {
            display: block !important;
            text-align: center;
            margin-bottom: 20px;
        }
        body {
            background-color: white !important;
        }
    }
    .print-header {
        display: none;
    }
    .table-laporan thead th {
        background-color: #f8f9fc;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
    }
</style>
@endpush

@section('content')
<div class="print-header">
    <h2 class="fw-bold mb-0">LAPORAN OPERASIONAL HARIAN</h2>
    <h4 class="text-muted">Pabrik Mie Soun Purwanta</h4>
    <p class="mb-0">Tanggal Laporan: <strong>{{ date('d F Y', strtotime($tanggal)) }}</strong></p>
</div>

<div class="row mb-4 no-print">
    <div class="col-md-6">
        <form action="{{ route('laporan.index') }}" method="GET" class="d-flex align-items-center">
            <label class="me-3 fw-bold text-nowrap">Pilih Tanggal:</label>
            <input type="date" name="tanggal" class="form-control me-2" value="{{ $tanggal }}">
            <button type="submit" class="btn btn-primary px-4"><i class="fas fa-filter me-2"></i>Filter</button>
        </form>
    </div>
    <div class="col-md-6 text-end">
        <button onclick="window.print()" class="btn btn-dark px-4 shadow-sm"><i class="fas fa-print me-2"></i>Cetak Laporan</button>
    </div>
</div>

<div class="row">
    <!-- Rekap Produksi -->
    <div class="col-12 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-industry me-2"></i>Rekap Produksi Harian</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle table-laporan">
                        <thead class="table-light">
                            <tr>
                                <th width="100">Jam</th>
                                <th>Bahan Baku Digunakan</th>
                                <th>Total Hasil (kg)</th>
                                <th>Total Modal / Biaya</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($laporan['produksi'] as $p)
                            <tr>
                                <td class="fw-bold text-primary">{{ date('H:i', strtotime($p['created_at'])) }}</td>
                                <td>
                                    <ul class="list-unstyled mb-0 small">
                                        @foreach($p['details'] as $detail)
                                            <li><i class="fas fa-check-circle me-1 text-success"></i>{{ $detail['bahan_baku']['nama'] ?? '-' }}: <strong>{{ $detail['jumlah_digunakan'] }} {{ $detail['bahan_baku']['satuan'] ?? '' }}</strong></li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ number_format($p['total_gram']/1000, 1, ',', '.') }} kg</div>
                                </td>
                                <td class="text-danger fw-bold">Rp {{ number_format($p['total_biaya_produksi'], 0, ',', '.') }}</td>
                                <td><small class="text-muted">{{ $p['catatan'] ?? '-' }}</small></td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-center py-4 text-muted">Tidak ada aktivitas produksi hari ini.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaksi Masuk/Keluar -->
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-boxes-stacked me-2"></i>Log Transaksi Bahan Baku</h6>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0 table-laporan">
                    <thead class="small text-muted">
                        <tr>
                            <th class="ps-3">Nama Bahan</th>
                            <th>Tipe</th>
                            <th class="text-end pe-3">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporan['transaksi_bahan_baku'] as $tbb)
                        <tr>
                            <td class="ps-3 fw-bold">{{ $tbb['bahan_baku']['nama'] ?? '-' }}</td>
                            <td>
                                @if($tbb['jenis'] == 'masuk')
                                    <span class="text-success small"><i class="fas fa-arrow-down me-1"></i>Masuk</span>
                                @else
                                    <span class="text-danger small"><i class="fas fa-arrow-up me-1"></i>Keluar</span>
                                @endif
                            </td>
                            <td class="text-end pe-3"><strong>{{ $tbb['jumlah'] }}</strong> <small>{{ $tbb['bahan_baku']['satuan'] ?? '' }}</small></td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center py-4 text-muted small">Belum ada transaksi bahan baku.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 font-weight-bold text-info"><i class="fas fa-box me-2"></i>Log Penjualan / Keluar Soun Jadi</h6>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0 table-laporan">
                    <thead class="small text-muted">
                        <tr>
                            <th class="ps-3">Keterangan</th>
                            <th>Tipe</th>
                            <th class="text-center">Jumlah (kg)</th>
                            <th class="text-end pe-3">Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporan['transaksi_soun'] as $ts)
                        <tr>
                            <td class="ps-3 small fw-bold">{{ $ts['keterangan'] }}</td>
                            <td>
                                <span class="badge {{ $ts['jenis'] == 'masuk' ? 'bg-success' : 'bg-danger' }} small" style="font-size: 0.7rem;">
                                    {{ $ts['jenis'] == 'masuk' ? 'Masuk' : 'Keluar / Jual' }}
                                </span>
                            </td>
                            <td class="text-center">{{ $ts['jumlah_kg'] }} kg</td>
                            <td class="text-end pe-3 text-success fw-bold">
                                @if($ts['jenis'] == 'keluar')
                                    Rp {{ number_format($ts['total_pendapatan'] ?? 0, 0, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center py-4 text-muted small">Belum ada log keluar/masuk soun.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
