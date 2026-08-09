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
            $table->json('potongan_items')->nullable()->after('jumlah_potongan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('spms', function (Blueprint $table) {
            $table->dropColumn('potongan_items');
        });
    }
};
