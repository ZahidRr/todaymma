<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TeknisiController; 
use App\Http\Controllers\ManajemenController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Redirect halaman utama ke login
Route::redirect('/', '/login');

// 1. Route Dashboard Utama (Polisi Lalu Lintas)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Group Route yang membutuhkan Login
Route::middleware('auth')->group(function () {
    
    // 2. Route Profile (Bawaan Laravel Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ==========================================
    // 3. ROUTE GROUP BERDASARKAN ROLE
    // ==========================================

    // KHUSUS SALES
    Route::middleware(['role:sales'])->prefix('sales')->group(function () {
        Route::get('/dashboard', [SalesController::class, 'index'])->name('sales.dashboard');
        
        // Rute Client
        Route::get('/clients', [SalesController::class, 'clients'])->name('sales.clients.index');
        Route::get('/clients/create', [SalesController::class, 'create'])->name('sales.clients.create');
        Route::post('/clients', [SalesController::class, 'storeClient'])->name('sales.clients.store');
        
        // Rute Baru: Detail & Terminasi
        Route::get('/clients/{id}', [SalesController::class, 'showClient'])->name('sales.clients.show');
        Route::post('/clients/{id}/terminate', [SalesController::class, 'terminateClient'])->name('sales.clients.terminate');
        
        Route::get('/ticket', [SalesController::class, 'ticket'])->name('sales.ticket');
        
        // Rute Upload Struk (Hapus kata /sales di depannya karena sudah kena prefix)
        Route::post('/invoices/{id}/upload', [SalesController::class, 'uploadProof'])->name('sales.invoices.upload');
        Route::post('/sales/ticket/store', [App\Http\Controllers\SalesController::class, 'storeTicket'])->name('sales.ticket.store');
        Route::post('/sales/clients/{id}/reschedule', [App\Http\Controllers\SalesController::class, 'rescheduleClient'])->name('sales.clients.reschedule');
    });

// KHUSUS ADMIN (BILLING & OPERASIONAL)
Route::middleware(['role:admin'])->prefix('admin')->group(function () {
    // Halaman Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // --- Halaman Khusus Verifikasi Tagihan ---
    Route::get('/verifikasi', [AdminController::class, 'verifikasi'])->name('admin.verifikasi');
    // Route untuk ACC Pembayaran
    Route::post('/invoices/{id}/approve', [AdminController::class, 'approvePayment'])->name('admin.invoices.approve');
    
    // --- Data Invoice & PDF ---
    Route::get('/invoices', [AdminController::class, 'invoices'])->name('admin.invoices');
    Route::get('/invoices/{id}/download', [AdminController::class, 'downloadInvoice'])->name('admin.invoices.download');
    
    // --- ROUTE DATABASE CLIENT ---
    Route::get('/clients', [AdminController::class, 'clients'])->name('admin.clients');
    Route::get('/clients/{id}/edit', [AdminController::class, 'editClient'])->name('admin.clients.edit');
    Route::delete('/clients/{id}', [AdminController::class, 'destroyClient'])->name('admin.clients.destroy');
    
    // --- TAMPILAN INVENTORY ---
    Route::get('/inventory', [AdminController::class, 'inventory'])->name('admin.inventory');

    // --- ROUTE KONTROL SAKTI (ISOLIR & TAGIHAN) ---
    // Buat Tagihan Baru (Gunakan nama route yang dicari oleh UI)
    Route::post('/clients/{id}/generate-invoice', [AdminController::class, 'generateInvoice'])->name('admin.invoices.generate');
    // Perintah Isolir Klien
    Route::post('/clients/{id}/isolate', [AdminController::class, 'isolateClient'])->name('admin.clients.isolate');
});

    // KHUSUS TEKNISI
    Route::middleware(['role:teknisi'])->prefix('teknisi')->group(function () {
        Route::get('/dashboard', [TeknisiController::class, 'index'])->name('teknisi.dashboard');
        Route::post('/execute-task', [TeknisiController::class, 'executeTask'])->name('teknisi.execute');
        Route::get('/ticket', [TeknisiController::class, 'ticket'])->name('teknisi.ticket');
        Route::get('/instalasi', [TeknisiController::class, 'instalasi'])->name('teknisi.instalasi');
        
        // TAMBAHAN RUTE ISOLIR (BARU)
        Route::get('/isolir', [TeknisiController::class, 'isolir'])->name('teknisi.isolir');
        
        // Inventory Teknisi (Full CRUD)
        Route::get('/inventory', [TeknisiController::class, 'inventory'])->name('teknisi.inventory');
        Route::post('/inventory', [TeknisiController::class, 'storeInventory'])->name('teknisi.inventory.store');
        Route::put('/inventory/{id}', [TeknisiController::class, 'updateInventory'])->name('teknisi.inventory.update');
        Route::delete('/inventory/{id}', [TeknisiController::class, 'destroyInventory'])->name('teknisi.inventory.destroy');
    });

    // KHUSUS MANAJEMEN (MENGGUNAKAN PREFIX 'MANAGER' AGAR MATCH DENGAN DASHBOARDCONTROLLER)
    Route::middleware(['role:manajemen'])->prefix('manager')->group(function () {
        Route::get('/dashboard', [ManajemenController::class, 'index'])->name('manager.dashboard');
        
        // Rute Inventory (Tampil, Tambah, Hapus)
        Route::get('/inventory', [ManajemenController::class, 'inventory'])->name('manager.inventory');
        Route::post('/inventory', [ManajemenController::class, 'storeInventory'])->name('manager.inventory.store');
        Route::delete('/inventory/{id}', [ManajemenController::class, 'destroyInventory'])->name('manager.inventory.destroy');
        
        Route::get('/clients', [ManajemenController::class, 'clients'])->name('manager.clients');
        Route::get('/reports', function () { return 'Halaman Laporan Keuangan'; })->name('manager.reports'); 
    });

});

require __DIR__.'/auth.php';