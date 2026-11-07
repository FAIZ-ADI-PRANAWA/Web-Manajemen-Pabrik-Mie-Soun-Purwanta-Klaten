<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stok_souns', function (Blueprint $table) {
            $table->dropColumn(['stok_pack_3kg', 'stok_pack_4kg']);
            $table->double('stok_kg')->default(0)->after('id');
        });

        Schema::table('transaksi_souns', function (Blueprint $table) {
            $table->dropColumn(['jumlah_pack_3kg', 'jumlah_pack_4kg']);
            $table->double('jumlah_kg')->default(0)->after('jenis');
        });
        
        Schema::table('produksis', function (Blueprint $table) {
            $table->dropColumn(['jumlah_pack_3kg', 'jumlah_pack_4kg']);
        });
        
        DB::table('harga_juals')->truncate();
        DB::table('harga_juals')->insert([
            'kemasan' => '1kg',
            'harga' => 22000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // Also fix StokSoun since we reset it
        DB::table('stok_souns')->truncate();
        DB::table('stok_souns')->insert(['id' => 1, 'stok_kg' => 0]);
    }

    public function down(): void
    {
        Schema::table('produksis', function (Blueprint $table) {
            $table->integer('jumlah_pack_3kg')->default(0);
            $table->integer('jumlah_pack_4kg')->default(0);
        });

        Schema::table('transaksi_souns', function (Blueprint $table) {
            $table->dropColumn('jumlah_kg');
            $table->integer('jumlah_pack_3kg')->default(0);
            $table->integer('jumlah_pack_4kg')->default(0);
        });

        Schema::table('stok_souns', function (Blueprint $table) {
            $table->dropColumn('stok_kg');
            $table->integer('stok_pack_3kg')->default(0);
            $table->integer('stok_pack_4kg')->default(0);
        });
    }
};
