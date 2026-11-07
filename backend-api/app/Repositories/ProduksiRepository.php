<?php

namespace App\Repositories;

use App\Models\Produksi;

class ProduksiRepository
{
    public function create(array $data)
    {
        return Produksi::create($data);
    }

    public function getAll()
    {
        return Produksi::orderBy('tanggal_produksi', 'desc')->get();
    }
}
