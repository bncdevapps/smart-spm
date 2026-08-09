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
            $table->string('id_biling_ppn')->nullable()->after('ppn');
            $table->json('pajak_lain_items')->nullable()->after('jumlah_pajak_lain');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('spms', function (Blueprint $table) {
            $table->dropColumn(['id_biling_ppn', 'pajak_lain_items']);
        });
    }
};
