<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HargaJual;
use App\Models\BahanBaku;
use Illuminate\Http\Request;

class HargaJualController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => HargaJual::all()
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'prices' => 'required|array',
            'prices.*.id' => 'required|exists:harga_juals,id',
            'prices.*.harga' => 'required|numeric|min:0',
            'bahan_bakus' => 'nullable|array',
            'bahan_bakus.*.id' => 'required|exists:bahan_bakus,id',
            'bahan_bakus.*.harga_beli_satuan' => 'required|numeric|min:0'
        ]);

        foreach ($validated['prices'] as $priceData) {
            HargaJual::where('id', $priceData['id'])->update(['harga' => $priceData['harga']]);
        }
        
        if (isset($validated['bahan_bakus'])) {
            foreach ($validated['bahan_bakus'] as $bbData) {
                BahanBaku::where('id', $bbData['id'])->update(['harga_beli_satuan' => $bbData['harga_beli_satuan']]);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Harga berhasil diperbarui'
        ]);
    }
}
