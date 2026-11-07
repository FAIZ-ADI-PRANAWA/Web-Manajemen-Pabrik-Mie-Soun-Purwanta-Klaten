<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProduksiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'tanggal' => $this->tanggal_produksi,
            'total_biaya' => $this->total_biaya_produksi,
            'total_kg' => $this->total_gram / 1000,
            'catatan' => $this->catatan,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
