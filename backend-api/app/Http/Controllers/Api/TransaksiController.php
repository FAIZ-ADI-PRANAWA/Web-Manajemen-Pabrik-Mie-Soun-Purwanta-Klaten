<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TransaksiBahanBaku;
use App\Models\TransaksiSoun;
use App\Models\BahanBaku;
use App\Models\StokSoun;
use App\Models\HargaJual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class TransaksiController extends Controller
{
    public function storeBahanBaku(Request $request)
    {
        $validated = $request->validate([
            'bahan_baku_id' => 'required|exists:bahan_bakus,id',
            'jenis' => 'required|in:masuk,keluar',
            'jumlah' => 'required|numeric|min:0.1',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        DB::beginTransaction();
        try {
            $transaksi = TransaksiBahanBaku::create($validated);
            
            $bahanBaku = BahanBaku::findOrFail($validated['bahan_baku_id']);
            if ($validated['jenis'] === 'masuk') {
                $bahanBaku->stok += $validated['jumlah'];
            } else {
                if ($bahanBaku->stok < $validated['jumlah']) {
                    throw new Exception('Stok bahan baku tidak mencukupi');
                }
                $bahanBaku->stok -= $validated['jumlah'];
            }
            $bahanBaku->save();

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Transaksi berhasil dicatat'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }

    public function storeSoun(Request $request)
    {
        $validated = $request->validate([
            'jenis' => 'required|in:masuk,keluar',
            'jumlah_kg' => 'required|numeric|min:0.1',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        DB::beginTransaction();
        try {
            $total_pendapatan = 0;

            if ($validated['jenis'] === 'keluar') {
                $harga1kg = HargaJual::where('kemasan', '1kg')->value('harga') ?? 22000;
                $total_pendapatan = $validated['jumlah_kg'] * $harga1kg;
            }

            $transaksi = TransaksiSoun::create(array_merge($validated, [
                'total_pendapatan' => $total_pendapatan
            ]));
            
            $stokSoun = StokSoun::firstOrCreate(['id' => 1]);
            if ($validated['jenis'] === 'masuk') {
                $stokSoun->stok_kg += $validated['jumlah_kg'];
            } else {
                if ($stokSoun->stok_kg < $validated['jumlah_kg']) {
                    throw new Exception('Stok soun tidak mencukupi untuk dikeluarkan/dijual');
                }
                $stokSoun->stok_kg -= $validated['jumlah_kg'];
            }
            $stokSoun->save();

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Transaksi berhasil dicatat'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }
}
