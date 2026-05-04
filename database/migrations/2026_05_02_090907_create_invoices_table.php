<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke Klien (Tagihan ini milik siapa?)
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            
            // Informasi Tagihan
            $table->string('billing_period'); // Contoh: "Mei 2026" atau "Pemasangan Baru"
            $table->decimal('amount', 12, 2); // Nominal tagihan, misal: 276000.00
            
            // Bukti & Status Pembayaran
            $table->string('payment_proof')->nullable(); // Foto struk khusus tagihan ini
            $table->enum('status', ['belum_bayar', 'menunggu_verifikasi', 'lunas'])->default('belum_bayar');
            
            // Relasi ke Admin (Siapa yang nge-ACC tagihan ini?)
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('verified_at')->nullable(); // Kapan di-ACC?
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};