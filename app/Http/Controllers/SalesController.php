<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer; 
use App\Models\Invoice; // PASTIKAN MODEL INVOICE DI-IMPORT
use Carbon\Carbon;

class SalesController extends Controller
{
    /**
     * 1. Menampilkan Halaman Dashboard Sales
     */
    public function index()
    {
        $user = Auth::user();
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek()->subDays(2); 
        
        $jadwalMingguIni = [
            'Senin' => 2,   
            'Selasa' => 1,  
            'Rabu' => 3,    
            'Kamis' => 0,   
            'Jumat' => 2,   
        ];

        return view('sales.dashboard', compact('user', 'jadwalMingguIni'));
    }

    /**
     * 2. Menampilkan Halaman Daftar Klien (Milik Sales Ini)
     */
    public function clients()
    {
        $user = Auth::user();
        // Mengambil data klien beserta tagihannya agar bisa dicek status bayarnya di view
        $clients = Customer::with('invoices')
                    ->where('sales_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('sales.clients', compact('user', 'clients'));
    }

    /**
     * 3. Menampilkan Halaman Form Registrasi Klien Baru
     */
    public function create()
    {
        $user = Auth::user();
        return view('sales.create_client', compact('user'));
    }

    /**
     * 4. Menyimpan Data Klien Baru + BIKIN INVOICE
     */
    public function storeClient(Request $request)
    {
        $validatedData = $request->validate([
            'nik' => 'required|string|max:20',
            'nationality' => 'required|string',
            'name' => 'required|string|max:255',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string',
            'occupation' => 'required|string',
            'phone_1' => 'required|string|max:20',
            'phone_2' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'residence' => 'required|string',
            'tower' => 'required|string',
            'floor' => 'required|string',
            'unit' => 'required|string',
            'unit_status' => 'required|string',
            'package' => 'required|string',
            'install_date' => 'required|date',
            
            // Dokumen Klien
            'ktp_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'selfie_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'support_doc' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'power_of_attorney' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            
            // Validasi Input Pembayaran (Sesuai Radio Button di View)
            'payment_status' => 'required|in:belum_bayar,menunggu_verifikasi',
            'payment_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $validatedData['sales_id'] = Auth::id();
        $validatedData['status'] = 'pending'; 

        // Upload Dokumen Klien
        if ($request->hasFile('ktp_file')) {
            $validatedData['ktp_file'] = $request->file('ktp_file')->store('customers/ktp', 'public');
        }
        if ($request->hasFile('selfie_file')) {
            $validatedData['selfie_file'] = $request->file('selfie_file')->store('customers/selfie', 'public');
        }
        if ($request->hasFile('support_doc')) {
            $validatedData['support_doc'] = $request->file('support_doc')->store('customers/support', 'public');
        }
        if ($request->hasFile('power_of_attorney')) {
            $validatedData['power_of_attorney'] = $request->file('power_of_attorney')->store('customers/poa', 'public');
        }

        // Hapus array payment_proof dan payment_status dari array validatedData Klien,
        // karena dua data itu miliknya tabel INVOICES, bukan tabel CUSTOMERS!
        $paymentStatus = $validatedData['payment_status'];
        unset($validatedData['payment_status']);
        unset($validatedData['payment_proof']);

        // A. SIMPAN DATA KE TABEL CUSTOMERS
        $customer = Customer::create($validatedData);

        // B. SIAPKAN HARGA PAKET UNTUK INVOICE
        $hargaPaket = [
            'promo_30_1m' => 250000,
            'promo_30_3m' => 276000,
            'promo_30_6m' => 516000,
            'promo_50_1y' => 1344000,
            'promo_50_3m' => 386400,
            'promo_50_6m' => 722400,
            'promo_spesial_50_1m' => 290000,
        ];
        $nominalInvoice = $hargaPaket[$request->package] ?? 0;

        // C. UPLOAD STRUK TRANSFER (JIKA ADA)
        $paymentProofPath = null;
        if ($request->hasFile('payment_proof') && $paymentStatus === 'menunggu_verifikasi') {
            $paymentProofPath = $request->file('payment_proof')->store('payments', 'public');
        }

        // D. SIMPAN DATA KE TABEL INVOICES
        Invoice::create([
            'customer_id' => $customer->id,
            'billing_period' => 'Biaya Pendaftaran & Instalasi',
            'amount' => $nominalInvoice,
            'payment_proof' => $paymentProofPath,
            'status' => $paymentStatus, 
        ]);

        return redirect()->route('sales.clients.index')->with('success', 'Klien baru berhasil didaftarkan dan Invoice telah dibuat!');
    }

    /**
     * 5. Menampilkan Halaman Ticket Troubleshoot
     */
/**
     * 5. Menampilkan Halaman Ticket Troubleshoot (Sales)
     */
    public function ticket()
    {
        $user = Auth::user();

        // Ambil daftar klien milik Sales ini saja (untuk Dropdown Form)
        $clients = Customer::where('sales_id', $user->id)
                           ->where('status', '!=', 'terminated')
                           ->get();

        // Ambil riwayat tiket yang pernah dibuat untuk klien milik Sales ini
        $tickets = \App\Models\Task::with(['customer', 'technician'])
            ->where('task_type', 'troubleshoot')
            ->whereHas('customer', function($q) use ($user) {
                $q->where('sales_id', $user->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('sales.ticket', compact('user', 'clients', 'tickets'));
    }

    /**
     * Menyimpan Tiket Baru ke Antrean Teknisi
     */
    public function storeTicket(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'category' => 'required|string',
            'priority' => 'required|string',
            'description' => 'required|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Gabungkan detail untuk ditampilkan ke Teknisi
        $notes = $request->description . " | Kategori: " . $request->category . " | Prioritas: " . $request->priority;

        // Proses Upload Foto (Jika ada)
        $path = null;
        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('tickets', 'public');
        }

        // Buat Tugas Baru
        \App\Models\Task::create([
            'customer_id' => $request->customer_id,
            'task_type' => 'troubleshoot',
            'status' => 'pending',
            'notes' => $notes,
            'attachment' => $path 
        ]);

        return redirect()->back()->with('success', 'Tiket Gangguan berhasil dikirim! Teknisi akan segera menanganinya.');
    }

    /**
     * 6. Menampilkan Halaman Detail Klien
     */
    public function showClient($id)
    {
        $user = Auth::user();
        // Pastikan narik data invoices juga pakai eager loading
        $client = Customer::with('invoices')->where('id', $id)->where('sales_id', $user->id)->firstOrFail();
        
        return view('sales.client_detail', compact('user', 'client'));
    }

    /**
     * 7. Meminta Terminasi (Berhenti Berlangganan)
     */
    public function terminateClient($id)
    {
        $user = Auth::user();
        $client = Customer::where('id', $id)->where('sales_id', $user->id)->firstOrFail();
        
        // 1. Ubah status klien jadi Menunggu Penarikan
        $client->update(['status' => 'req_terminate']); 
        
        // 2. OTOMATIS BUAT TASK TERMINASI UNTUK TEKNISI
        \App\Models\Task::create([
            'customer_id' => $client->id,
            'task_type' => 'terminasi',
            'status' => 'pending',
        ]);
        
        return redirect()->route('sales.clients.index')->with('success', 'Permintaan penghentian langganan terkirim. Tugas Bongkar Perangkat otomatis masuk ke daftar antrean Teknisi!');
    }

    /**
     * 8. Mengunggah Bukti Pembayaran (Susulan)
     */
    public function uploadProof(Request $request, $id)
    {
        $request->validate([
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $invoice = Invoice::findOrFail($id);

        // Keamanan tambahan: Pastikan invoice ini benar milik klien dari sales yang sedang login
        if ($invoice->customer->sales_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Simpan gambar dan ubah status tagihan
        $path = $request->file('payment_proof')->store('payments', 'public');
        
        $invoice->update([
            'payment_proof' => $path,
            'status' => 'menunggu_verifikasi'
        ]);

        return redirect()->back()->with('success', 'Bukti bayar berhasil disusulkan dan sedang menunggu verifikasi Admin!');
    }

    /**
     * 9. Mengubah Jadwal Pemasangan (Reschedule)
     */
    public function rescheduleClient(Request $request, $id)
    {
        $request->validate([
            'install_date' => 'required|date|after_or_equal:today', // Tanggal tidak boleh mundur ke masa lalu
        ]);

        $user = Auth::user();
        $client = Customer::where('id', $id)->where('sales_id', $user->id)->firstOrFail();

        // Keamanan tambahan: Pastikan klien statusnya masih pending (belum diinstalasi teknisi)
        if ($client->status !== 'pending') {
            return redirect()->back()->with('error', 'Gagal merubah jadwal! Klien ini sudah terpasang atau sudah aktif.');
        }

        // Simpan tanggal baru
        $client->update([
            'install_date' => $request->install_date
        ]);

        return redirect()->back()->with('success', 'Jadwal pemasangan berhasil diperbarui! Urutan antrean teknisi akan otomatis menyesuaikan.');
    }
}