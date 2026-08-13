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
        Schema::table('penyedias', function (Blueprint $table) {
            if (!Schema::hasColumn('penyedias', 'name_instansi')) {
                $table->string('name_instansi')->nullable()->after('nama');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penyedias', function (Blueprint $table) {
            if (Schema::hasColumn('penyedias', 'name_instansi')) {
                $table->dropColumn('name_instansi');
            }
        });
    }
};
