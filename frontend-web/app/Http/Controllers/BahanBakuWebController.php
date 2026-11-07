<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class BahanBakuWebController extends Controller
{
    private $apiUrl = 'http://127.0.0.1:8000/api/v1';

    public function index()
    {
        $response = Http::withToken(Session::get('api_token'))->get("{$this->apiUrl}/bahan-baku");
        $bahanBakus = $response->json('data') ?? [];

        return view('bahan_baku.index', compact('bahanBakus'));
    }

    public function store(Request $request)
    {
        $response = Http::withToken(Session::get('api_token'))->post("{$this->apiUrl}/bahan-baku", [
            'nama' => $request->nama,
            'satuan' => $request->satuan,
            'stok' => $request->stok ?? 0,
            'harga_beli_satuan' => $request->harga_beli_satuan ?? 0,
        ]);

        if ($response->successful()) {
            return back()->with('success', 'Bahan baku berhasil ditambahkan!');
        }

        return back()->with('error', 'Gagal menambahkan bahan baku.');
    }
}
