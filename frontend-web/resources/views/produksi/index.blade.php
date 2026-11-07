@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Riwayat Produksi Harian</h2>
    <a href="{{ route('produksi.create') }}" class="btn btn-success">Catat Produksi Baru</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Total Hasil (kg)</th>
                    <th>Total Modal / Biaya</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produksis as $index => $produksi)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ date('d M Y', strtotime($produksi['tanggal'])) }}</td>
                    <td><span class="badge bg-primary fs-6">{{ number_format($produksi['total_kg'], 1, ',', '.') }} kg</span></td>
                    <td><span class="text-danger fw-bold">Rp {{ number_format($produksi['total_biaya'], 0, ',', '.') }}</span></td>
                    <td>{{ $produksi['catatan'] ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4">Belum ada data produksi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
