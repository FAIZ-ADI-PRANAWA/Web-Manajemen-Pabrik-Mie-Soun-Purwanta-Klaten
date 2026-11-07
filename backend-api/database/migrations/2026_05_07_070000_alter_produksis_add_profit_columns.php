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
        Schema::table('produksis', function (Blueprint $table) {
            // Remove old single-bahan columns (nullable if they don't exist yet in a fresh run)
            $table->dropConstrainedForeignId('bahan_baku_id');
            $table->dropColumn(['jumlah_bahan_digunakan']);

            // New columns for multi-bahan & profit
            $table->decimal('total_biaya_produksi', 12, 2)->default(0);
            $table->integer('total_gram')->default(0);
            $table->integer('jumlah_pack_3kg')->default(0);
            $table->integer('jumlah_pack_4kg')->default(0);
            $table->decimal('total_pendapatan', 12, 2)->default(0);
            $table->decimal('profit', 12, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produksis', function (Blueprint $table) {
            $table->foreignId('bahan_baku_id')->constrained('bahan_bakus');
            $table->double('jumlah_bahan_digunakan');

            $table->dropColumn([
                'total_biaya_produksi',
                'total_gram',
                'jumlah_pack_3kg',
                'jumlah_pack_4kg',
                'total_pendapatan',
                'profit',
            ]);
        });
    }
};
