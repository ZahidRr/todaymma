<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Inventory;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class TeknisiController extends Controller
{
    /**
     * Menampilkan Halaman Dashboard Utama Teknisi
     */
    public function index()
    {
        $user = Auth::user();

        // 1. Ambil SEMUA tugas yang masih 'pending' (belum diambil siapa pun) 
        // ATAU tugas yang sedang dikerjakan khusus oleh teknisi yang login ini.
        $activeTasks = Task::with('customer')
            ->where('status', '!=', 'completed')
            ->where(function ($query) use ($user) {
                $query->whereNull('technician_id')
                      ->orWhere('technician_id', $user->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // 2. Klasifikasi tugas untuk dihitung di Card Dashboard
        $tugasInstalasi = $activeTasks->where('task_type', 'instalasi_baru');
        $tugasIsolir = $activeTasks->whereIn('task_type', ['isolir', 'buka_isolir', 'terminasi']); // Masukkan terminasi ke card Enable/Disable
        $tiketGangguan = $activeTasks->where('task_type', 'troubleshoot');

        // 3. Ambil data inventaris (Untuk card carousel Router & Kabel)
        $inventories = Inventory::all();

        // 4. Ambil history pengerjaan (5 terakhir) HANYA untuk teknisi yang bersangkutan
        $riwayatTugas = Task::with('customer')
            ->where('technician_id', $user->id)
            ->where('status', 'completed')
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();

        return view('teknisi.dashboard', compact(
            'user', 
            'tugasInstalasi', 
            'tugasIsolir', 
            'tiketGangguan', 
            'inventories',
            'riwayatTugas',
            'activeTasks'
        ));
    }

    /**
     * Menampilkan Halaman Ticket Troubleshoot
     */
    public function ticket()
    {
        $user = Auth::user();
        
        // Ambil SEMUA tiket gangguan (troubleshoot) yang belum selesai
        // Tanpa filter technician_id agar menjadi Pool Antrean untuk semua teknisi
        $tickets = Task::with('customer')
            ->where('task_type', 'troubleshoot')
            ->where('status', '!=', 'completed')
            ->orderBy('created_at', 'asc') // Urutkan dari yang paling lama mengantre
            ->get();
            
        return view('teknisi.ticket', compact('user', 'tickets'));
    }

    /**
     * Menampilkan Halaman Instalasi Baru
     */
    public function instalasi()
    {
        $pendingInstalls = Customer::with('sales')
                            ->where('status', 'pending')
                            ->orderBy('created_at', 'asc')
                            ->get();

        // Ambil SEMUA perangkat router yang masih tersedia di gudang
        $routers = Inventory::where('category', 'perangkat')
                            ->where('status', 'Tersedia')
                            ->whereNotNull('serial_number')
                            ->get();
                            
        // Kirim data Box Kabel agar bisa dipilih Teknisi saat menyelesaikan instalasi
        $cables = Inventory::where('category', 'material')
                           ->where('item_name', 'LIKE', '%Kabel%')
                           ->where('stock_quantity', '>', 0)
                           ->get();

        // Kirim $routers dan $cables ke tampilan blade
        return view('teknisi.instalasi', compact('pendingInstalls', 'routers', 'cables'));
    }

    /**
     * Menampilkan Halaman Aktivasi & Isolir (POOL TUGAS)
     */
    public function isolir()
    {
        $user = Auth::user();
        
        // Ambil SEMUA tugas Isolir, Buka Isolir, dan Terminasi yang belum selesai
        // Filter technician_id sudah DIHAPUS agar semua tugas antrean terlihat!
        $tasks = Task::with('customer')
            ->whereIn('task_type', ['isolir', 'buka_isolir', 'terminasi'])
            ->where('status', '!=', 'completed')
            ->orderBy('created_at', 'asc')
            ->get();
            
        return view('teknisi.isolir', compact('user', 'tasks'));
    }

    /**
     * Menampilkan Halaman Gudang Inventory
     */
    public function inventory()
    {
        $user = Auth::user();
        
        // 1. Ambil data perangkat (Gudang)
        $perangkat = Inventory::where('category', 'perangkat')->orderBy('created_at', 'desc')->get();
        
        // 2. Ambil data material (Gudang)
        $material = Inventory::where('category', 'material')->orderBy('created_at', 'desc')->get();
        
        // 3. Ambil data Router yang sudah terpasang dari tabel Customer
        $routerTerpasang = Customer::whereNotNull('router_sn')
                                   ->orderBy('installed_at', 'desc')
                                   ->get();
                                   
        // 4. Ambil data Kabel yang sudah terpakai beserta Kode Box-nya
        $kabelTerpasang = Customer::whereNotNull('cable_length')
                                  ->where('cable_length', '>', 0)
                                  ->orderBy('installed_at', 'desc')
                                  ->get();
        
        return view('teknisi.inventory', compact('user', 'perangkat', 'material', 'routerTerpasang', 'kabelTerpasang'));
    }

    // Tambah Barang Baru (Create)
    public function storeInventory(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'category' => 'required|in:perangkat,material',
            'serial_number' => 'nullable|string|max:100', // Dipakai juga untuk input Kode Box Kabel
            'stock_quantity' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
        ]);

        Inventory::create($request->all());
        return redirect()->back()->with('success', 'Barang berhasil ditambahkan ke gudang!');
    }

    // Edit Barang (Update)
    public function updateInventory(Request $request, $id)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'category' => 'required|in:perangkat,material',
            'serial_number' => 'nullable|string|max:100',
            'stock_quantity' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
        ]);

        $inventory = Inventory::findOrFail($id);
        $inventory->update($request->all());
        return redirect()->back()->with('success', 'Data barang berhasil diperbarui!');
    }

    // Hapus Barang (Delete)
    public function destroyInventory($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();
        return redirect()->back()->with('success', 'Barang berhasil dihapus dari gudang!');
    }

    /**
     * Fungsi utama untuk mengeksekusi SEMUA jenis tugas dari Teknisi
     */
    public function executeTask(Request $request)
    {
        $request->validate([
            'task_id' => 'nullable|exists:tasks,id',
            'customer_id' => 'nullable|exists:customers,id',
            'kabel_terpakai' => 'nullable|numeric|min:0',
            'router_sn' => 'nullable|string',
            'cable_sn' => 'nullable|string',
            'action' => 'nullable|string|in:start,complete' 
        ]);

        DB::beginTransaction();

        try {
            // ========================================================
            // A. LOGIKA INSTALASI BARU
            // ========================================================
            if ($request->filled('customer_id')) {
                $customer = Customer::findOrFail($request->customer_id);

                if ($request->filled('kabel_terpakai')) {
                    $kabel = null;
                    if ($request->filled('cable_sn')) {
                        $kabel = Inventory::where('serial_number', $request->cable_sn)->first();
                    } else {
                        $kabel = Inventory::where('item_name', 'LIKE', '%Kabel%')->where('stock_quantity', '>', 0)->first();
                    }

                    if ($kabel && $kabel->stock_quantity >= $request->kabel_terpakai) {
                        $kabel->decrement('stock_quantity', $request->kabel_terpakai);
                        $customer->cable_length = $request->kabel_terpakai;
                        $customer->cable_sn = $kabel->serial_number; 
                    }
                }

                if ($request->filled('router_sn')) {
                    $router = Inventory::where('serial_number', $request->router_sn)->first();
                    if ($router) {
                        $router->status = 'Terpakai';
                        $router->stock_quantity = 0;
                        $router->save();
                    }
                }

                $customer->status = 'active';
                $customer->installed_at = now(); 
                $customer->router_sn = $request->router_sn; 
                $customer->save();

                DB::commit();
                return redirect()->back()->with('success', 'Instalasi Selesai! Kabel & Router terpotong otomatis.');
            }

            // ========================================================
            // B. LOGIKA TUGAS LAPANGAN / REMOTE (Isolir, Aktivasi, Terminasi, Troubleshoot)
            // ========================================================
            if ($request->filled('task_id')) {
                $task = Task::with('customer')->findOrFail($request->task_id);

                // === FASE 1: TEKNISI KLIK "MULAI KERJAKAN" ===
                if ($request->action == 'start') {
                    // Pakai cara save langsung (bypass mass-assignment / $fillable model)
                    $task->status = 'on_progress';
                    $task->technician_id = Auth::id(); // Kunci tugas
                    $task->save();
                    
                    DB::commit();
                    return redirect()->back()->with('success', 'Tugas dikunci! Silakan proses di WinBox/Lapangan sekarang.');
                }

                // === FASE 2: TEKNISI KLIK "SELESAIKAN TUGAS" ===
                if ($request->action == 'complete') {
                    $customer = $task->customer; 

                    // 1. LOGIKA KHUSUS TIKET TROUBLESHOOT (Wajib Laporan & Foto)
                    if ($task->task_type == 'troubleshoot') {
                        $request->validate([
                            'root_cause' => 'required|string',
                            'action_taken' => 'required|string',
                            'proof_image' => 'required|image|mimes:jpg,jpeg,png|max:2048' // Wajib foto maksimal 2MB
                        ]);

                        // Simpan foto bukti pengerjaan
                        $proofPath = null;
                        if ($request->hasFile('proof_image')) {
                            $proofPath = $request->file('proof_image')->store('proofs', 'public');
                        }

                        // Simpan laporan ke database task
                        $task->root_cause = $request->root_cause;
                        $task->action_taken = $request->action_taken;
                        $task->proof_image = $proofPath;
                    }

                    // 2. LOGIKA ISOLIR & TERMINASI (Tetap sama seperti sebelumnya)
                    if ($task->task_type == 'isolir') {
                        if ($customer) {
                            $customer->status = 'isolated';
                            $customer->save();
                        }
                    }
                    elseif ($task->task_type == 'buka_isolir') {
                        if ($customer) {
                            $customer->status = 'active';
                            $customer->save();
                        }
                    }
                    elseif ($task->task_type == 'terminasi') {
                        if ($customer) {
                            $customer->status = 'terminated';
                            
                            // Otomatis kembalikan Router ke Gudang Inventory
                            if ($customer->router_sn) {
                                $router = Inventory::where('serial_number', $customer->router_sn)->first();
                                if ($router) {
                                    $router->status = 'Tersedia'; // Ubah status jadi sedia
                                    $router->stock_quantity = 1;  // Tambah stok jadi 1
                                    $router->save();
                                }
                                
                                // KUNCI PENTING: Copot SN dari data Klien agar benar-benar terlepas!
                                $customer->router_sn = null; 
                            }
                            $customer->save();
                        }
                    }

                    // 3. TUTUP TUGAS MENJADI SELESAI
                    $task->status = 'completed';
                    $task->save();

                    DB::commit();
                    return redirect()->back()->with('success', 'Mantap! Tugas selesai dan laporan berhasil disimpan ke riwayat klien.');
                }
            }

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }
}