<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke Sales (Siapa yang bawa pelanggan ini)
            $table->foreignId('sales_id')->nullable()->constrained('users')->onDelete('set null'); 
            
            // 1. Data Pribadi
            $table->string('nik', 20)->nullable();
            $table->string('nationality', 10)->nullable();
            $table->string('name');
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('gender', 15)->nullable();
            $table->string('occupation')->nullable();
            
            // 2. Kontak
            $table->string('phone_1', 20)->nullable();
            $table->string('phone_2', 20)->nullable();
            $table->string('email')->nullable();
            
            // 3. Lokasi Instalasi
            $table->string('residence')->nullable(); // Contoh: Gading Nias
            $table->string('tower'); // Contoh: Emerald, Dahlia
            $table->string('floor', 10)->nullable();
            $table->string('unit', 20); // Dulu room_number, kita ganti unit agar seragam
            $table->string('unit_status')->nullable();
            
            // 4. Layanan & Jadwal
            $table->string('package')->nullable();
            $table->date('install_date')->nullable();
            
            // 5. Upload Dokumen (Menyimpan path/lokasi file)
            $table->string('ktp_file')->nullable();
            $table->string('selfie_file')->nullable();
            $table->string('support_doc')->nullable();
            $table->string('power_of_attorney')->nullable();

            // 6. Status Operasional & Aset
            // (Kita pakai string agar fleksibel dengan logika Backend Teknisi kita)
            $table->string('status')->default('pending'); // pending, active, isolated, terminated
            $table->timestamp('installed_at')->nullable(); // Waktu mulai aktif (patokan 1 Tahun)
            $table->string('router_sn')->nullable(); // SN Router yang dipinjamkan

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};