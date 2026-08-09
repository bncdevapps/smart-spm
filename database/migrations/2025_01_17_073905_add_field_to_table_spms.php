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
            // $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->string('instansi')->after('jumlah');
            $table->text('keperluan')->after('jumlah');
            $table->string('npwp_bendahara')->after('penyedia');
            $table->string('kode_akun_pajak')->after('penyedia');
            $table->string('kode_jenis_setoran_pajak')->after('penyedia');
            $table->string('id_biling_pajak')->after('penyedia');
            $table->integer('ppn')->unsigned()->default(0)->after('penyedia');
            $table->string('pajak_lain')->after('penyedia');
            $table->integer('jumlah_pajak_lain')->unsigned()->default(0)->after('penyedia');
            $table->integer('jumlah_netto')->unsigned()->default(0)->after('penyedia');
            $table->string('nomor_sp2d')->nullable()->after('jumlah_netto');
            $table->timestamp('tanggal_bayar_pajak')->nullable()->after('jumlah_netto');
            $table->string('ntpn')->nullable()->after('jumlah_netto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('spms', function (Blueprint $table) {
            //
        });
    }
};
