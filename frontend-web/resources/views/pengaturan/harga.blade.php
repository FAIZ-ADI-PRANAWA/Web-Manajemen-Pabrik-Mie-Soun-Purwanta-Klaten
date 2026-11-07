@extends('layouts.app')

@section('page_title', 'Pengaturan Harga')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('harga-jual.update') }}" method="POST">
            @csrf
            
            <!-- Harga Jual -->
            <div class="card shadow-sm border-0 overflow-hidden mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold text-success"><i class="fas fa-tags me-2"></i>Update Harga Jual Soun</h5>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted small mb-4">Ubah harga jual Soun per kg untuk memperbarui perhitungan omzet dan profit pada dashboard secara otomatis.</p>
                    
                    @foreach($hargaJuals as $index => $hj)
                    <div class="mb-3">
                        <label class="form-label fw-bold">Harga Soun ({{ $hj['kemasan'] }})</label>
                        <input type="hidden" name="prices[{{ $index }}][id]" value="{{ $hj['id'] }}">
                        <div class="input-group input-group-lg shadow-sm">
                            <span class="input-group-text bg-light border-end-0">Rp</span>
                            <input type="number" name="prices[{{ $index }}][harga]" class="form-control border-start-0 ps-0" value="{{ $hj['harga'] }}" required min="0">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Harga Bahan Baku -->
            <div class="card shadow-sm border-0 overflow-hidden mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold text-primary"><i class="fas fa-box-open me-2"></i>Update Harga Bahan Baku</h5>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted small mb-4">Ubah harga beli satuan untuk masing-masing bahan baku. Harga ini akan digunakan untuk menghitung modal pada setiap kali produksi.</p>
                    
                    <div class="row">
                        @foreach($bahanBakus as $index => $bb)
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold">{{ $bb['nama'] }} <small class="text-muted">/ {{ $bb['satuan'] }}</small></label>
                            <input type="hidden" name="bahan_bakus[{{ $index }}][id]" value="{{ $bb['id'] }}">
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-light border-end-0">Rp</span>
                                <input type="number" name="bahan_bakus[{{ $index }}][harga_beli_satuan]" class="form-control border-start-0 ps-0" value="{{ $bb['harga_beli_satuan'] }}" required min="0">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="d-grid mt-4 mb-5">
                <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow">
                    <i class="fas fa-save me-2"></i> Simpan Semua Perubahan Harga
                </button>
            </div>
        </form>
        
        <div class="mt-4 text-center">
            <a href="{{ route('dashboard') }}" class="text-decoration-none text-muted small">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
@endsection
