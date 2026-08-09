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
            $table->enum('status_ajukan', ['draft', 'diajukan','verifikasi', 'menunggu berkas asli', 'perlu perbaikan', 'diproses', 'sp2d terbit', 'spm ditolak'])->default('draft')->change();
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
