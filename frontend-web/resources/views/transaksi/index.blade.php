@extends('layouts.app')

@section('page_title', 'Pencatatan Barang Masuk/Keluar')

@section('content')
<div class="row">
    <div class="col-lg-12">
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm mb-4">{{ session('error') }}</div>
        @endif

        <div class="card shadow border-0">
            <div class="card-header bg-white py-3">
                <ul class="nav nav-pills card-header-pills" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active fw-bold px-4" id="pills-bahan-tab" data-bs-toggle="pill" data-bs-target="#pills-bahan">
                            <i class="fas fa-boxes-stacked me-2"></i> Restock Bahan Baku
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link fw-bold px-4" id="pills-soun-tab" data-bs-toggle="pill" data-bs-target="#pills-soun">
                            <i class="fas fa-box me-2"></i> Penjualan Soun Jadi
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body p-4">
                <div class="tab-content" id="pills-tabContent">
                    <!-- Tab Bahan Baku -->
                    <div class="tab-pane fade show active" id="pills-bahan">
                        <h5 class="fw-bold mb-4">Restock Bahan Baku</h5>
                        <form action="{{ route('transaksi.bahan.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="jenis" value="masuk">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small">Pilih Bahan</label>
                                    <select name="bahan_baku_id" id="bahan_baku_select" class="form-select" required>
                                        <option value="" data-satuan="">-- Pilih Bahan Baku --</option>
                                        @foreach($bahanBakus as $bb)
                                            <option value="{{ $bb['id'] }}" data-satuan="{{ $bb['satuan'] }}">
                                                {{ $bb['nama'] }} (Stok saat ini: {{ $bb['stok'] }} {{ $bb['satuan'] }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small text-muted">Tipe Transaksi</label>
                                    <div class="form-control-plaintext fw-bold text-success">
                                        <i class="fas fa-arrow-down me-1"></i> Barang Masuk (Restock)
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small">Jumlah Tambah Stok</label>
                                    <div class="input-group">
                                        <input type="number" step="0.1" name="jumlah" class="form-control" placeholder="Contoh: 10" required>
                                        <span class="input-group-text fw-bold bg-light" id="satuan_text">-</span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold small">Keterangan / Catatan</label>
                                <textarea name="keterangan" class="form-control" rows="2" placeholder="Contoh: Pembelian dari Supplier X"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm"><i class="fas fa-save me-2"></i> Simpan Restock</button>
                        </form>
                    </div>

                    <!-- Tab Soun Jadi -->
                    <div class="tab-pane fade" id="pills-soun">
                        <h5 class="fw-bold mb-4">Catat Penjualan Soun Jadi</h5>
                        <form action="{{ route('transaksi.soun.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="jenis" value="keluar">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold small text-muted">Tipe Transaksi</label>
                                    <div class="form-control-plaintext fw-bold text-danger">
                                        <i class="fas fa-arrow-up me-1"></i> Penjualan (Barang Keluar)
                                    </div>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label class="form-label fw-bold small">Jumlah Soun Terjual</label>
                                    <div class="input-group">
                                        <input type="number" step="0.1" name="jumlah_kg" class="form-control" placeholder="Contoh: 15" min="0.1" required>
                                        <span class="input-group-text fw-bold bg-light">kg</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small">Tanggal Penjualan</label>
                                    <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small">Keterangan / Tujuan</label>
                                    <input type="text" name="keterangan" class="form-control" placeholder="Contoh: Kirim ke Toko Sejahtera">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success px-5 rounded-pill shadow-sm"><i class="fas fa-check-circle me-2"></i> Simpan Penjualan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectBahan = document.getElementById('bahan_baku_select');
        const satuanText = document.getElementById('satuan_text');

        selectBahan.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const satuan = selectedOption.getAttribute('data-satuan');
            
            if (satuan) {
                satuanText.textContent = satuan;
            } else {
                satuanText.textContent = '-';
            }
        });
    });
</script>
@endpush
@endsection
