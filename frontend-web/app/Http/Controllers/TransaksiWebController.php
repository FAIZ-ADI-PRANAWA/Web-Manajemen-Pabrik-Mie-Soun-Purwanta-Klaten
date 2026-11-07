<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class TransaksiWebController extends Controller
{
    private $apiUrl = 'http://127.0.0.1:8000/api/v1';

    public function index()
    {
        // Untuk demo, kita arahkan ke form pencatatan
        $response = Http::withToken(Session::get('api_token'))->get("{$this->apiUrl}/bahan-baku");
        $bahanBakus = $response->json('data') ?? [];

        return view('transaksi.index', compact('bahanBakus'));
    }

    public function storeBahan(Request $request)
    {
        $response = Http::withToken(Session::get('api_token'))->post("{$this->apiUrl}/transaksi/bahan-baku", [
            'bahan_baku_id' => $request->bahan_baku_id,
            'jenis' => $request->jenis,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);

        if ($response->successful()) {
            return back()->with('success', 'Transaksi bahan baku berhasil dicatat!');
        }

        return back()->with('error', $response->json('message') ?? 'Gagal mencatat transaksi.');
    }

    public function storeSoun(Request $request)
    {
        $response = Http::withToken(Session::get('api_token'))->post("{$this->apiUrl}/transaksi/soun", [
            'jenis' => $request->jenis,
            'jumlah_kg' => $request->jumlah_kg,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);

        if ($response->successful()) {
            return back()->with('success', 'Transaksi soun berhasil dicatat!');
        }

        return back()->with('error', $response->json('message') ?? 'Gagal mencatat transaksi.');
    }
}
