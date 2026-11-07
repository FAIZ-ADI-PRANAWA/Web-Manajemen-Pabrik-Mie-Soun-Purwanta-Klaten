@extends('layouts.app')

@section('page_title', 'Dashboard Overview')

@section('content')

<!-- Welcome Banner -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm overflow-hidden" style="background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);">
            <div class="card-body p-4 text-white position-relative">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="fw-bold mb-1">Selamat Datang di Pabrik Mie Soun Purwanta!</h3>
                        <p class="mb-0 opacity-75">Sistem Manajemen Produksi dan Penjualan Pabrik Mie Soun Anda.</p>
                    </div>
                    <div class="col-md-4 text-end d-none d-md-block">
                        <i class="fas fa-industry fa-4x opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Stok Soun Jadi -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow-sm border-0 border-start border-success border-4 h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-2">Stok Soun Tersedia</div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ number_format($data['statistik']['stok_soun_kg'] ?? 0, 1, ',', '.') }} kg</div>
                        <div class="text-xs text-muted mt-2"><i class="fas fa-tag me-1"></i> Rp {{ number_format($data['harga_jual'] ?? 22000, 0, ',', '.') }} / kg</div>
                    </div>
                    <div class="col-auto">
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-warehouse fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Produksi Bulan Ini -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow-sm border-0 border-start border-primary border-4 h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">Produksi (Bulan Ini)</div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ number_format($data['statistik']['produksi_bulan_ini_kg'] ?? 0, 1, ',', '.') }} kg</div>
                        <div class="text-xs text-muted mt-2"><i class="fas fa-coins me-1"></i> Biaya: Rp {{ number_format($data['statistik']['total_biaya_bulan_ini'] ?? 0, 0, ',', '.') }}</div>
                    </div>
                    <div class="col-auto">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-industry fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Penjualan Bulan Ini -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow-sm border-0 border-start border-info border-4 h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-2">Penjualan (Bulan Ini)</div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ number_format($data['statistik']['penjualan_bulan_ini_kg'] ?? 0, 1, ',', '.') }} kg</div>
                        <div class="text-xs text-muted mt-2"><i class="fas fa-wallet me-1"></i> Omzet: Rp {{ number_format($data['statistik']['total_pendapatan_bulan_ini'] ?? 0, 0, ',', '.') }}</div>
                    </div>
                    <div class="col-auto">
                        <div class="bg-info bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-shopping-cart fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profit Netto Bulan Ini -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow-sm border-0 border-start {{ ($data['statistik']['total_profit_bulan_ini'] ?? 0) >= 0 ? 'border-success' : 'border-danger' }} border-4 h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold {{ ($data['statistik']['total_profit_bulan_ini'] ?? 0) >= 0 ? 'text-success' : 'text-danger' }} text-uppercase mb-2">Estimasi Profit (Bulan Ini)</div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">
                            Rp {{ number_format($data['statistik']['total_profit_bulan_ini'] ?? 0, 0, ',', '.') }}
                        </div>
                        <div class="text-xs text-muted mt-2">Omzet dikurangi Modal Produksi</div>
                    </div>
                    <div class="col-auto">
                        <div class="{{ ($data['statistik']['total_profit_bulan_ini'] ?? 0) >= 0 ? 'bg-success' : 'bg-danger' }} bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-hand-holding-usd fa-2x {{ ($data['statistik']['total_profit_bulan_ini'] ?? 0) >= 0 ? 'text-success' : 'text-danger' }}"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Stok Bahan Baku (Kiri) -->
    <div class="col-xl-4 col-lg-5 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-boxes-stacked me-2"></i>Kapasitas Bahan Baku</h6>
                <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-outline-primary shadow-sm"><i class="fas fa-plus me-1"></i>Restock</a>
            </div>
            <div class="card-body px-4 py-3">
                @if(isset($data['bahan_bakus']) && count($data['bahan_bakus']) > 0)
                    @foreach($data['bahan_bakus'] as $bb)
                        @php
                            // Menghitung status persentase (indikasi saja)
                            $bgClass = 'bg-success';
                            if ($bb['stok'] <= 0) $bgClass = 'bg-danger';
                            elseif ($bb['nama'] == 'Tepung Pati Aren' && $bb['stok'] < 2100) $bgClass = 'bg-warning';
                            elseif ($bb['nama'] == 'Kaporit' && $bb['stok'] < 28) $bgClass = 'bg-warning';
                            elseif ($bb['nama'] == 'Minyak Kelapa Sawit' && $bb['stok'] < 50) $bgClass = 'bg-warning';
                            elseif ($bb['nama'] == 'Kayu Bakar' && $bb['stok'] < 10) $bgClass = 'bg-warning';
                        @endphp
                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="fw-bold text-dark">{{ $bb['nama'] }}</span>
                                <span class="text-muted fw-bold">{{ $bb['stok'] }} {{ $bb['satuan'] }}</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar {{ $bgClass }} progress-bar-striped" role="progressbar" style="width: {{ $bgClass == 'bg-danger' ? '10%' : '100%' }}" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            @if($bgClass == 'bg-warning' || $bgClass == 'bg-danger')
                                <div class="text-xs text-danger mt-1"><i class="fas fa-exclamation-circle me-1"></i> Stok tidak cukup untuk 1x produksi!</div>
                            @endif
                        </div>
                    @endforeach
                @else
                    <p class="text-muted text-center py-4">Data bahan baku tidak tersedia.</p>
                @endif
                
                <hr>
                <div class="alert alert-secondary py-2 px-3 mb-0 mt-3 text-center small border">
                    <i class="fas fa-info-circle me-1"></i> <strong>Kebutuhan 1x Produksi:</strong><br>
                    2100kg Tepung, 28kg Kaporit, 50ml Minyak, 10krat Kayu Bakar
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Produksi vs Penjualan (Kanan) -->
    <div class="col-xl-8 col-lg-7 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-chart-area me-2"></i>Aktivitas Produksi & Penjualan (7 Hari Terakhir)</h6>
            </div>
            <div class="card-body">
                <div class="chart-area" style="height: 350px;">
                    <canvas id="activityChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('activityChart');
        if(!ctx) return;
        
        const chartData = @json($data['grafik'] ?? []);
        const labels = chartData.labels || ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
        const dataProduksi = chartData.produksi || [0,0,0,0,0,0,0];
        const dataPenjualan = chartData.penjualan || [0,0,0,0,0,0,0];

        new Chart(ctx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Produksi (kg)',
                        type: 'line',
                        data: dataProduksi,
                        borderColor: '#4e73df',
                        backgroundColor: 'rgba(78, 115, 223, 0.05)',
                        pointBackgroundColor: '#4e73df',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#4e73df',
                        pointRadius: 4,
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Penjualan (kg)',
                        type: 'bar',
                        data: dataPenjualan,
                        backgroundColor: '#36b9cc',
                        hoverBackgroundColor: '#2c9faf',
                        borderColor: '#36b9cc',
                        borderWidth: 1,
                        borderRadius: 4,
                        maxBarThickness: 40
                    }
                ]
            },
            options: {
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false,
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255, 0.9)',
                        titleColor: '#333',
                        bodyColor: '#666',
                        borderColor: '#ddd',
                        borderWidth: 1,
                        padding: 12,
                        boxPadding: 6
                    }
                }
            }
        });
    });
</script>
@endpush
