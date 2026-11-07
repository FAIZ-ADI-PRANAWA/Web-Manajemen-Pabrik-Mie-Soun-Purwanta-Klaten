<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProduksiRequest;
use App\Services\ProduksiService;
use App\Repositories\ProduksiRepository;
use App\Http\Resources\ProduksiResource;
use Exception;
use Illuminate\Http\Request;

class ProduksiController extends Controller
{
    protected $produksiService;
    protected $produksiRepository;

    public function __construct(ProduksiService $produksiService, ProduksiRepository $produksiRepository)
    {
        $this->produksiService = $produksiService;
        $this->produksiRepository = $produksiRepository;
    }

    public function index()
    {
        $data = $this->produksiRepository->getAll();
        return response()->json([
            'status' => 'success',
            'data' => ProduksiResource::collection($data)
        ]);
    }

    public function store(StoreProduksiRequest $request)
    {
        try {
            $produksi = $this->produksiService->catatProduksiBaru($request->validated());
            return response()->json([
                'status' => 'success',
                'message' => 'Produksi berhasil dicatat.',
                'data' => new ProduksiResource($produksi)
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}

