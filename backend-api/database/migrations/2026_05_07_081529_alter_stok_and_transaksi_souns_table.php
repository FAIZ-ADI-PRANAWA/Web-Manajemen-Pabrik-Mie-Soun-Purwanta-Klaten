<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('stok_souns', function (Blueprint $table) {
            $table->dropColumn('total_stok');
            $table->integer('stok_pack_3kg')->default(0)->after('id');
            $table->integer('stok_pack_4kg')->default(0)->after('stok_pack_3kg');
        });

        Schema::table('transaksi_souns', function (Blueprint $table) {
            $table->dropColumn('jumlah');
            $table->integer('jumlah_pack_3kg')->default(0)->after('jenis');
            $table->integer('jumlah_pack_4kg')->default(0)->after('jumlah_pack_3kg');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi_souns', function (Blueprint $table) {
            $table->dropColumn(['jumlah_pack_3kg', 'jumlah_pack_4kg']);
            $table->double('jumlah')->default(0);
        });

        Schema::table('stok_souns', function (Blueprint $table) {
            $table->dropColumn(['stok_pack_3kg', 'stok_pack_4kg']);
            $table->double('total_stok')->default(0);
        });
    }
};
