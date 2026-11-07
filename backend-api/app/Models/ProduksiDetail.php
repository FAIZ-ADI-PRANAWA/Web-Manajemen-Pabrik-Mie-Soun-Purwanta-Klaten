<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProduksiDetail extends Model
{
    protected $fillable = [
        'produksi_id', 'bahan_baku_id', 'jumlah_digunakan', 'biaya'
    ];

    public function produksi()
    {
        return $this->belongsTo(Produksi::class);
    }

    public function bahanBaku()
    {
        return $this->belongsTo(BahanBaku::class);
    }
}
