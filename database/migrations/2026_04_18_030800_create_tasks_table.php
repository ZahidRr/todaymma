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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            // Menghubungkan tugas ke pelanggan tertentu
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            
            // Menghubungkan tugas ke teknisi tertentu (mengambil dari tabel users)
            $table->foreignId('technician_id')->nullable()->constrained('users')->onDelete('set null');
            
            $table->enum('task_type', ['instalasi_baru', 'isolir', 'buka_isolir', 'troubleshoot']);
            $table->enum('status', ['pending', 'on_progress', 'completed'])->default('pending');
            $table->text('notes')->nullable(); // Catatan keluhan atau SN alat
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
