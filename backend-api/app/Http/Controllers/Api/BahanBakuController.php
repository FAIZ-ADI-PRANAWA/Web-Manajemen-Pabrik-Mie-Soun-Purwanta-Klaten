<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BahanBaku;
use Illuminate\Http\Request;

class BahanBakuController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => BahanBaku::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'satuan' => 'required|string',
            'stok' => 'nullable|numeric',
            'harga_beli_satuan' => 'nullable|numeric'
        ]);

        $bahan = BahanBaku::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Bahan baku berhasil ditambahkan',
            'data' => $bahan
        ]);
    }
}
