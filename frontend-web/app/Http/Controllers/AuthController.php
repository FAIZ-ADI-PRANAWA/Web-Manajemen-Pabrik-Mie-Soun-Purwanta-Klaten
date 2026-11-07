<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    private $apiUrl = 'http://127.0.0.1:8000/api';

    public function showLogin()
    {
        if (Session::has('api_token')) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $response = Http::post("{$this->apiUrl}/login", [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            $data = $response->json('data');
            Session::put('api_token', $data['token']);
            Session::put('user_name', $data['user']['name']);
            return redirect()->route('dashboard');
        }

        return back()->with('error', $response->json('message') ?? 'Login gagal. Periksa kembali akun Anda.');
    }

    public function logout()
    {
        // Optional: Call backend logout to revoke token
        if (Session::has('api_token')) {
            Http::withToken(Session::get('api_token'))->post("{$this->apiUrl}/logout");
        }

        Session::forget(['api_token', 'user_name']);
        return redirect()->route('login');
    }
}
