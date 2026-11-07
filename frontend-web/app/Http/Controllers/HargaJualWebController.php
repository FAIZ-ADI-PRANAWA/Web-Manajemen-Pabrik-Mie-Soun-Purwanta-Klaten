<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class HargaJualWebController extends Controller
{
    private $apiUrl = 'http://127.0.0.1:8000/api/v1';

    public function index()
    {
        $response = Http::withToken(Session::get('api_token'))->get("{$this->apiUrl}/harga-jual");
        $hargaJuals = $response->json('data') ?? [];
        
        $responseBb = Http::withToken(Session::get('api_token'))->get("{$this->apiUrl}/bahan-baku");
        $bahanBakus = $responseBb->json('data') ?? [];

        return view('pengaturan.harga', compact('hargaJuals', 'bahanBakus'));
    }

    public function update(Request $request)
    {
        $response = Http::withToken(Session::get('api_token'))->post("{$this->apiUrl}/harga-jual/update", [
            'prices' => $request->prices,
            'bahan_bakus' => $request->bahan_bakus
        ]);

        if ($response->successful()) {
            return redirect()->route('harga-jual.index')->with('success', 'Harga berhasil diperbarui');
        }

        return back()->with('error', 'Gagal memperbarui harga');
    }
}
