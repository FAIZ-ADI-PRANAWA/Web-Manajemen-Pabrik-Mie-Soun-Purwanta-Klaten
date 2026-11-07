<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produk_jadis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->decimal('ukuran_kg', 5, 2); // e.g., 3.00, 4.00
            $table->decimal('harga_jual', 12, 2); // selling price per pack
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_jadis');
    }
};
