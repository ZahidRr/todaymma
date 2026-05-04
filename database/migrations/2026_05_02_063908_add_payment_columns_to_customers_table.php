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
            // Menambahkan kolom upload struk pembayaran (opsional)
            $table->string('payment_proof')->nullable()->after('power_of_attorney');
            
            // Menambahkan status pembayaran
            $table->enum('payment_status', ['belum_bayar', 'menunggu_verifikasi', 'lunas'])
                  ->default('belum_bayar')
                  ->after('payment_proof');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['payment_proof', 'payment_status']);
        });
    }
};