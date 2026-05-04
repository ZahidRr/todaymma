<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Inventory;
use App\Models\Customer; 

class ManajemenController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $clients = Customer::orderBy('created_at', 'desc')->get();
        
        // 1. Hitung Statistik Dasar
        $totalClient = $clients->count();
        $clientAktif = $clients->where('status', 'active')->count();
        $clientMenunggak = $clients->where('status', 'isolated')->count();
        
        // 2. Hitung Churn (Klien Berhenti bulan ini)
        $clientChurn = $clients->where('status', 'terminated')
                               ->where('updated_at', '>=', now()->startOfMonth())
                               ->count();
                               
        // 3. Menghitung Incoming Installation (Menunggu Dipasang)
        $incomingInstalls = $clients->where('status', 'pending')->count();
                               
        // 4. Estimasi Pendapatan dari Client Aktif
        $pendapatan = 0;
        foreach ($clients->where('status', 'active') as $c) {
            if (str_contains($c->package, '30')) {
                $pendapatan += 200000;
            } elseif (str_contains($c->package, '50')) {
                $pendapatan += 300000;
            } elseif (str_contains($c->package, '100')) {
                $pendapatan += 500000;
            } else {
                $pendapatan += 250000; 
            }
        }

        return view('manajemen.dashboard', compact(
            'user', 'clients', 'totalClient', 'clientAktif', 'clientMenunggak', 'clientChurn', 'pendapatan', 'incomingInstalls'
        ));
    }

    public function inventory()
    {
        $user = Auth::user();
        
        $perangkat = Inventory::where('category', 'perangkat')->get();
        $material = Inventory::where('category', 'material')->get();
        
        return view('manajemen.inventory', compact('user', 'perangkat', 'material'));
    }

    public function storeInventory(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'category' => 'required|in:perangkat,material',
            'serial_number' => 'nullable|string|max:100', 
            'stock_quantity' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
        ]);

        Inventory::create($request->all());
        return redirect()->back()->with('success', 'Barang berhasil ditambahkan ke gudang!');
    }

    public function destroyInventory($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();
        return redirect()->back()->with('success', 'Barang berhasil dihapus dari gudang!');
    }

    public function clients()
    {
        $user = Auth::user();
        $clients = Customer::orderBy('created_at', 'desc')->get();
        return view('manajemen.clients', compact('user', 'clients')); 
    }
}