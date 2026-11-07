<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produksis', function (Blueprint $table) {
            $table->dropColumn(['total_pendapatan', 'profit']);
        });

        Schema::table('transaksi_souns', function (Blueprint $table) {
            $table->decimal('total_pendapatan', 12, 2)->default(0)->after('jumlah_kg');
        });
    }

    public function down(): void
    {
        Schema::table('transaksi_souns', function (Blueprint $table) {
            $table->dropColumn('total_pendapatan');
        });

        Schema::table('produksis', function (Blueprint $table) {
            $table->decimal('total_pendapatan', 12, 2)->default(0);
            $table->decimal('profit', 12, 2)->default(0);
        });
    }
};
