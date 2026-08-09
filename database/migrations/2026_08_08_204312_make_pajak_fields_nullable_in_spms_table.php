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
        Schema::table('spms', function (Blueprint $table) {
            $table->string('kode_akun_pajak')->nullable()->change();
            $table->string('kode_jenis_setoran_pajak')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('spms', function (Blueprint $table) {
            $table->string('kode_akun_pajak')->nullable(false)->change();
            $table->string('kode_jenis_setoran_pajak')->nullable(false)->change();
        });
    }
};
