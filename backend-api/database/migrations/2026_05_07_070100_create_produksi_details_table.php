<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('produksi_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produksi_id')->constrained('produksis')->onDelete('cascade');
            $table->foreignId('bahan_baku_id')->constrained('bahan_bakus');
            $table->double('jumlah_digunakan');
            $table->decimal('biaya', 12, 2); // jumlah * harga_beli_satuan saat itu
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produksi_details');
    }
};
