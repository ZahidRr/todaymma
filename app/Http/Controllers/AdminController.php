<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Inventory; 
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf; 

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // 1. Data untuk "To-Do List" Admin (Metrik Atas)
        $klienMenunggak = Customer::where('status', 'isolated')->count();
        $permintaanPasang = Customer::where('status', 'pending')->count();
        $klienBerhenti = Customer::where('status', 'req_terminate')
                                 ->orWhere('status', 'terminated')->count();
        
        // 2. Ambil data tagihan yang butuh verifikasi
        $butuhVerifikasi = Invoice::with('customer')
                                  ->where('status', 'menunggu_verifikasi')
                                  ->orderBy('updated_at', 'asc')
                                  ->get();
        $jumlahVerifikasi = $butuhVerifikasi->count();
        
        // 3. Cek barang yang stoknya menipis
        $stokMenipis = Inventory::where('stock_quantity', '<=', 5)->get();
        $jumlahStokMenipis = $stokMenipis->count();
        
        // 4. Data Klien Tunggakan
        $tabelTunggakan = Customer::where('status', 'isolated')
                                  ->orderBy('updated_at', 'desc')
                                  ->take(5)
                                  ->get();

        return view('admin.dashboard', compact(
            'user', 'klienMenunggak', 'permintaanPasang', 'klienBerhenti', 
            'stokMenipis', 'jumlahStokMenipis', 'tabelTunggakan',
            'butuhVerifikasi', 'jumlahVerifikasi'
        ));
    }

    public function approvePayment($id)
    {
        $invoice = Invoice::findOrFail($id);
        
        // 1. Ubah status Invoice jadi LUNAS
        $invoice->update([
            'status' => 'lunas',
            'verified_by' => Auth::id(),
            'verified_at' => now(),
        ]);

        // 2. Ubah juga status bayar di tabel Customer
        if ($invoice->customer) {
            $invoice->customer->update(['payment_status' => 'lunas']);
        }

        // 3. JIKA klien sedang terisolir, BUAT TASK untuk teknisi agar di-enable di WinBox
        if ($invoice->customer->status == 'isolated') {
            \App\Models\Task::create([
                'customer_id' => $invoice->customer->id,
                'task_type' => 'buka_isolir',
                'status' => 'pending',
                // technician_id biarkan kosong agar bisa diambil oleh siapa saja yang standby
            ]);
        }

        return redirect()->back()->with('success', 'Pembayaran berhasil diverifikasi. Task Buka Isolir otomatis diteruskan ke Teknisi!');
    }

    /**
     * Menampilkan Halaman Khusus Antrean Verifikasi Tagihan
     */
    public function verifikasi()
    {
        // Tarik semua tagihan yang statusnya belum di-ACC
        $butuhVerifikasi = Invoice::with('customer')
                                  ->where('status', 'menunggu_verifikasi')
                                  ->orderBy('updated_at', 'asc')
                                  ->get();
        
        return view('admin.verifikasi', compact('butuhVerifikasi'));
    }

    /**
     * Menampilkan Halaman Daftar Semua Invoice
     */
    public function invoices()
    {
        // Ambil semua data invoice, urutkan dari yang terbaru
        $invoices = Invoice::with('customer')->orderBy('created_at', 'desc')->get();
        
        return view('admin.invoices', compact('invoices'));
    }

    /**
     * Generate & Download PDF Invoice
     */
    public function downloadInvoice($id)
    {
        // Ambil data invoice beserta data kliennya
        $invoice = Invoice::with('customer')->findOrFail($id);
        
        // Load sebuah file template Blade khusus untuk PDF
        $pdf = Pdf::loadView('admin.invoice_template', compact('invoice'));
        
        // Atur ukuran kertas ke A4
        $pdf->setPaper('A4', 'portrait');

        // Unduh otomatis dengan nama file yang rapi
        $namaFile = 'Invoice_ConnectMe_' . str_replace(' ', '_', $invoice->customer->name) . '_' . $invoice->billing_period . '.pdf';
        
        return $pdf->download($namaFile);
    }

    /**
     * Fitur Generate Tagihan (Invoice) Baru untuk Client
     */
    public function generateInvoice($id)
    {
        $client = Customer::findOrFail($id);

        // 1. Tentukan nominal harga
        // Sementara kita set default ke Rp 276.000 sesuai gambar struk
        $harga = 276000; 

        // 2. Buat string periode bulan depan untuk pengecekan (Misal: Mei 2026)
        $periodeBulanDepan = now()->addMonth()->translatedFormat('F Y'); 

        // 3. VALIDASI: Cek apakah tagihan bulan depan sudah pernah dibuat untuk menghindari double invoice
        $cekTagihan = Invoice::where('customer_id', $client->id)
                             ->where('billing_period', 'like', '%' . substr($periodeBulanDepan, 0, 3) . '%')
                             ->first();

        if ($cekTagihan) {
            return redirect()->back()->with('error', 'Gagal! Tagihan untuk periode ' . $periodeBulanDepan . ' sudah pernah dibuat sebelumnya.');
        }

        // 4. Buat format text periode yang cantik (Contoh: "Periode 01 Apr - 30 Apr 2026")
        $namaBulan = substr($periodeBulanDepan, 0, 3);
        $tahun = now()->addMonth()->format('Y');
        $akhirBulan = now()->addMonth()->endOfMonth()->format('d');
        $formatPeriode = "Periode 01 {$namaBulan} - {$akhirBulan} {$namaBulan} {$tahun}";

        // 5. Simpan ke database
        Invoice::create([
            'customer_id' => $client->id,
            'amount' => $harga,
            'billing_period' => $formatPeriode,
            'status' => 'belum_bayar',
        ]);

        return redirect()->back()->with('success', 'Tagihan baru untuk ' . $client->name . ' berhasil dibuat! Silakan cek di menu Data Tagihan (Invoice).');
    }

    /**
     * Menampilkan Database Seluruh Client & Fitur Search
     */
    public function clients(Request $request)
    {
        $query = Customer::query();

        // Jika Admin mengetik sesuatu di kotak pencarian
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('unit', 'like', '%' . $searchTerm . '%')
                  ->orWhere('phone_1', 'like', '%' . $searchTerm . '%');
        }

        // Ambil semua data dari seluruh Sales, urutkan dari yang terbaru
        $clients = $query->orderBy('created_at', 'desc')->get();
        
        return view('admin.clients', compact('clients'));
    }

    /**
     * Proses Menghapus Client
     */
    public function destroyClient($id)
    {
        $client = Customer::findOrFail($id);
        $client->delete();

        return redirect()->back()->with('success', 'Data Client berhasil dihapus dari sistem!');
    }

    /**
     * Menampilkan Halaman Inventory Gudang (Read-Only)
     */
    public function inventory()
    {
        // Ambil data perangkat (Router/Modem)
        $perangkat = Inventory::where('category', 'perangkat')->orderBy('created_at', 'desc')->get();
        
        // Ambil data material (Kabel, Splitter, dll)
        $material = Inventory::where('category', 'material')->orderBy('created_at', 'desc')->get();
        
        return view('admin.inventory', compact('perangkat', 'material'));
    }

    /**
     * Mengirim Perintah Isolir ke Teknisi
     */
    public function isolateClient($id)
    {
        $client = Customer::findOrFail($id);

        // Cek agar tidak terjadi double task (mencegah Admin spam klik)
        $existingTask = \App\Models\Task::where('customer_id', $client->id)
            ->where('task_type', 'isolir')
            ->where('status', '!=', 'completed')
            ->first();

        if($existingTask) {
            return redirect()->back()->with('error', 'Tugas isolir untuk klien ini sudah ada di antrean Teknisi!');
        }

        // Buat Task Isolir baru ke tabel tasks
        \App\Models\Task::create([
            'customer_id' => $client->id,
            'task_type' => 'isolir',
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Perintah Isolir berhasil dikirim! Teknisi akan segera mengeksekusinya di WinBox.');
    }
    
}