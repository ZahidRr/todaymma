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
        Schema::table('customers', function (Blueprint $table) {
            // Menambahkan 2 kolom baru untuk keperluan teknisi
            $table->integer('cable_length')->nullable()->after('router_sn'); 
            $table->string('cable_sn')->nullable()->after('cable_length');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            // Menghapus kolom jika di-rollback
            $table->dropColumn(['cable_length', 'cable_sn']);
        });
    }
};