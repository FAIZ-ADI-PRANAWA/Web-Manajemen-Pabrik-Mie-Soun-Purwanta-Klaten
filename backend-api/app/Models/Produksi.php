<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    protected $fillable = [
        'tanggal_produksi', 'total_biaya_produksi', 'total_gram', 'catatan'
    ];

    public function details()
    {
        return $this->hasMany(ProduksiDetail::class);
    }
}
