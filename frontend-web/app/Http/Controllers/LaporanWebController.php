<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class LaporanWebController extends Controller
{
    private $apiUrl = 'http://127.0.0.1:8000/api/v1';

    public function index(Request $request)
    {
        $tanggal = $request->query('tanggal', date('Y-m-d'));
        
        $response = Http::withToken(Session::get('api_token'))->get("{$this->apiUrl}/laporan/harian", [
            'tanggal' => $tanggal
        ]);

        $laporan = $response->json('data') ?? [];

        return view('laporan.index', compact('laporan', 'tanggal'));
    }
}
