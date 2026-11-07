@extends('layouts.app')

@section('page_title', 'Manajemen Bahan Baku')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Bahan Baku (Data Tetap)</h6>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>
        @endif
        
        <div class="alert alert-info border-0 shadow-sm">
            <i class="fas fa-info-circle me-1"></i> Bahan baku sudah ditetapkan oleh sistem. Anda hanya dapat melakukan penambahan stok melalui menu <strong>Transaksi / Restock</strong>.
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nama Bahan</th>
                        <th>Stok Saat Ini</th>
                        <th>Satuan</th>
                        <th>Harga Beli / Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bahanBakus as $bb)
                    <tr>
                        <td>#{{ $bb['id'] }}</td>
                        <td class="fw-bold">{{ $bb['nama'] }}</td>
                        <td>
                            <span class="badge {{ $bb['stok'] > 10 ? 'bg-success' : 'bg-danger' }} rounded-pill px-3">
                                {{ number_format($bb['stok'], 1) }}
                            </span>
                        </td>
                        <td>{{ $bb['satuan'] }}</td>
                        <td>Rp {{ number_format($bb['harga_beli_satuan'] ?? 0, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Belum ada data bahan baku.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
