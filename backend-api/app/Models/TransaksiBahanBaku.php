<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiBahanBaku extends Model
{
    protected $fillable = ['bahan_baku_id', 'jenis', 'jumlah', 'tanggal', 'keterangan'];

    public function bahanBaku()
    {
        return $this->belongsTo(BahanBaku::class);
    }
}
