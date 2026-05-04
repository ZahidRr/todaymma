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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->enum('category', ['perangkat', 'material'])->default('material');
            
            // TAMBAHAN UNTUK ROUTER
            $table->string('serial_number')->nullable()->unique();
            $table->string('status')->default('Tersedia'); 
            
            // UNTUK MATERIAL KABEL
            $table->integer('stock_quantity')->nullable()->default(1);
            $table->string('unit')->nullable()->default('Unit'); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
