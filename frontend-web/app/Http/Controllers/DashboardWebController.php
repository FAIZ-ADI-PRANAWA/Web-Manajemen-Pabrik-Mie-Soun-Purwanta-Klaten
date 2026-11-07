<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class DashboardWebController extends Controller
{
    private $apiUrl = 'http://127.0.0.1:8000/api/v1';

    public function index()
    {
        $response = Http::withToken(Session::get('api_token'))->get("{$this->apiUrl}/dashboard");
        
        $data = $response->json('data') ?? [
            'statistik' => [
                'total_bahan_baku' => 0,
                'stok_soun' => 0,
                'produksi_bulan_ini' => 0
            ],
            'grafik' => []
        ];

        return view('dashboard', compact('data'));
    }
}
