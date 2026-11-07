<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BahanBaku;
use App\Models\StokSoun;
use App\Models\Produksi;
use App\Models\TransaksiSoun;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Data Stok Bahan Baku (Detailed)
        $bahanBakus = BahanBaku::all();
        
        $stokSoun = StokSoun::first() ?? new StokSoun(['stok_kg' => 0]);
        
        $totalProduksiBulanIni = Produksi::whereMonth('tanggal_produksi', Carbon::now()->month)
                                         ->sum('total_gram');
        $totalProduksiBulanIniKg = $totalProduksiBulanIni / 1000;

        $totalPenjualanBulanIniKg = TransaksiSoun::where('jenis', 'keluar')
            ->whereMonth('tanggal', Carbon::now()->month)
            ->sum('jumlah_kg');

        $totalPendapatanBulanIni = TransaksiSoun::where('jenis', 'keluar')
            ->whereMonth('tanggal', Carbon::now()->month)
            ->sum('total_pendapatan');

        $totalBiayaBulanIni = Produksi::whereMonth('tanggal_produksi', Carbon::now()->month)
            ->sum('total_biaya_produksi');

        $totalProfitBulanIni = $totalPendapatanBulanIni - $totalBiayaBulanIni;

        // Data Harga Jual
        $hargaJual = \App\Models\HargaJual::first();

        // Data Grafik 7 Hari Terakhir
        $labels = [];
        $produksiData = [];
        $penjualanData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $labels[] = Carbon::now()->subDays($i)->format('d M');

            $prod = Produksi::whereDate('tanggal_produksi', $date)->sum('total_gram');
            $produksiData[] = $prod / 1000; // In kg

            $jual = TransaksiSoun::where('jenis', 'keluar')->whereDate('tanggal', $date)->sum('jumlah_kg');
            $penjualanData[] = (float) $jual;
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'bahan_bakus' => $bahanBakus,
                'statistik' => [
                    'stok_soun_kg' => $stokSoun->stok_kg,
                    'produksi_bulan_ini_kg' => $totalProduksiBulanIniKg,
                    'penjualan_bulan_ini_kg' => $totalPenjualanBulanIniKg,
                    'total_profit_bulan_ini' => $totalProfitBulanIni,
                    'total_pendapatan_bulan_ini' => $totalPendapatanBulanIni,
                    'total_biaya_bulan_ini' => $totalBiayaBulanIni
                ],
                'harga_jual' => $hargaJual ? $hargaJual->harga : 0,
                'grafik' => [
                    'labels' => $labels,
                    'produksi' => $produksiData,
                    'penjualan' => $penjualanData
                ]
            ]
        ]);
    }
}
