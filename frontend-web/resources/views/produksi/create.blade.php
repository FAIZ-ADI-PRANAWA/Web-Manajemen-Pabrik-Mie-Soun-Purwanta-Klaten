@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Catat Produksi Harian</h5>
    </div>
    <div class="card-body">
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="alert alert-info">
            <strong>Info Produksi:</strong> 1x Produksi menghasilkan <strong>1900 kg Mie Soun</strong> dan membutuhkan:
            <ul>
                <li>Tepung Pati Aren: 2100 kg</li>
                <li>Kaporit: 28 kg</li>
                <li>Minyak Kelapa Sawit: 50 ml</li>
                <li>Kayu Bakar: 10 krat</li>
            </ul>
            Stok bahan saat ini: 
            @foreach($bahanBakus as $bb)
                <span class="badge bg-secondary">{{ $bb['nama'] }}: {{ $bb['stok'] }} {{ $bb['satuan'] }}</span> 
            @endforeach
        </div>

        <form action="{{ route('produksi.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Tanggal Produksi</label>
                <input type="date" name="tanggal_produksi" class="form-control" required value="{{ old('tanggal_produksi') }}">
            </div>

            <div class="mb-3">
                <label>Jumlah Produksi (Berapa Kali)</label>
                <input type="number" name="kali_produksi" id="kali_produksi" class="form-control" value="1" min="1" required>
                <small class="form-text text-muted">Total target Soun: <span id="target_soun" class="fw-bold text-success">1900</span> kg</small>
            </div>

            <div class="mb-3">
                <label>Catatan</label>
                <textarea name="catatan" class="form-control" rows="3">{{ old('catatan') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Produksi</button>
            <a href="{{ route('produksi.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const kaliInput = document.getElementById('kali_produksi');
    const targetSpan = document.getElementById('target_soun');
    
    kaliInput.addEventListener('input', function() {
        let kali = parseInt(this.value) || 0;
        targetSpan.textContent = kali * 1900;
    });
});
</script>
@endsection
