<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    protected $fillable = ['nama', 'stok', 'satuan', 'harga_beli_satuan'];
}
