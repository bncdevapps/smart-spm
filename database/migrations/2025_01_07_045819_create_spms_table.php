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
        Schema::create('spms', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal');
            $table->string('nomor');
            $table->enum('jenis', ['UP', 'GU', 'TU', 'LS', 'Tunjangan/Gaji'])->default('UP');
            $table->integer('jumlah')->unsigned()->default(0);
            $table->string('penyedia');
            $table->text('keterangan');
            $table->string('dokumen');
            $table->enum('status', ['draft', 'diajukan'])->default('draft');
            $table->enum('posisi_ajukan', ['bendahara', 'ppk', 'verifikator', 'admin'])->default('bendahara');
            $table->enum('status_ajukan', ['draft', 'diajukan', 'verifikasi', 'perlu perbaikan', 'diproses', 'sp2d terbit', 'spm ditolak'])->default('draft');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spms');
    }
};
