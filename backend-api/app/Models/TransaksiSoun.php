<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiSoun extends Model
{
    protected $fillable = ['jenis', 'jumlah_kg', 'total_pendapatan', 'tanggal', 'keterangan'];
}
