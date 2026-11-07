<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produksi;
use App\Models\TransaksiBahanBaku;
use App\Models\TransaksiSoun;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function harian(Request $request)
    {
        $tanggal = $request->query('tanggal', date('Y-m-d'));

        $produksi = Produksi::with('details.bahanBaku')->whereDate('tanggal_produksi', $tanggal)->get();
        $transaksiBahanBaku = TransaksiBahanBaku::with('bahanBaku')->whereDate('tanggal', $tanggal)->get();
        
        // Hanya ambil Penjualan (keluar) untuk Soun, karena produksi sudah ada di tabel sendiri
        $transaksiSoun = TransaksiSoun::where('jenis', 'keluar')->whereDate('tanggal', $tanggal)->get();

        return response()->json([
            'status' => 'success',
            'data' => [
                'tanggal' => $tanggal,
                'produksi' => $produksi,
                'transaksi_bahan_baku' => $transaksiBahanBaku,
                'transaksi_soun' => $transaksiSoun
            ]
        ]);
    }
}
