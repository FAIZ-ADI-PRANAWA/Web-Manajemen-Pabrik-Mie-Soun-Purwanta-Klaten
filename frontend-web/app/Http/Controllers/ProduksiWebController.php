<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ProduksiWebController extends Controller
{
    private $apiUrl = 'http://127.0.0.1:8000/api/v1'; // Base URL Backend API

    public function index()
    {
        // Consume API GET
        $response = Http::withToken(Session::get('api_token'))->get("{$this->apiUrl}/produksi");
        $produksis = $response->json('data') ?? [];

        return view('produksi.index', compact('produksis'));
    }

    public function create()
    {
        // Ambil list bahan baku untuk pengecekan stok (opsional, tapi bagus untuk info user)
        $bahanBakus = Http::withToken(Session::get('api_token'))->get("{$this->apiUrl}/bahan-baku")->json('data') ?? [];
        return view('produksi.create', compact('bahanBakus'));
    }

    public function store(Request $request)
    {
        $response = Http::withToken(Session::get('api_token'))->post("{$this->apiUrl}/produksi", [
            'tanggal_produksi' => $request->tanggal_produksi,
            'kali_produksi' => $request->kali_produksi ?? 1,
            'catatan' => $request->catatan,
        ]);

        if ($response->successful()) {
            return redirect()->route('produksi.index')->with('success', 'Data produksi berhasil disimpan!');
        }

        // Handle error jika gagal validasi dari API atau stok kurang
        return back()->with('error', $response->json('message') ?? 'Terjadi kesalahan.')->withInput();
    }
}
