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
            $table->string('id_biling_pajak')->nullable()->change();
            $table->string('pajak_lain')->nullable()->change();
            $table->string('potongan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('spms', function (Blueprint $table) {
            $table->string('id_biling_pajak')->nullable(false)->change();
            $table->string('pajak_lain')->nullable(false)->change();
            $table->string('potongan')->nullable(false)->change();
        });
    }
};
