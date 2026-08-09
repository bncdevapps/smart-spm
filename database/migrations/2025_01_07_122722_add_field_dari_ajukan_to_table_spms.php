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
            $table->enum('dari_ajukan', ['ppk', 'verifikator', 'admin'])->after('posisi_ajukan');
            $table->text('catatan_ppk')->after('status_ajukan')->nullable();
            $table->text('catatan_verifikator')->after('status_ajukan')->nullable();
            $table->text('catatan_admin')->after('status_ajukan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('spms', function (Blueprint $table) {
            $table->dropColumn('dari_ajukan');
            $table->dropColumn('catatan_ppk');
            $table->dropColumn('catatan_verifikator');
            $table->dropColumn('catatan_admin');
        });
    }
};
