<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Task;
use App\Models\User;

class CustomerTaskSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID teknisi yang sudah ada dari UserSeeder sebelumnya
        $zahid = User::where('username', 'zahid')->first();
        $zidan = User::where('username', 'zidan')->first();

        // 1. Buat Data Pelanggan
        $c1 = Customer::create(['name' => 'Budi Santoso', 'tower' => 'Emerald', 'room_number' => '12A', 'status' => 'pending']);
        $c2 = Customer::create(['name' => 'Siti Aminah', 'tower' => 'Dahlia', 'room_number' => '05C', 'status' => 'aktif']);
        $c3 = Customer::create(['name' => 'Andi Wijaya', 'tower' => 'Alamanda', 'room_number' => '20B', 'status' => 'isolir']);

        // 2. Buat Data Tugas (Task)
        // Tugas Pasang Baru untuk Zahid
        Task::create([
            'customer_id' => $c1->id,
            'technician_id' => $zahid->id,
            'task_type' => 'instalasi_baru',
            'status' => 'pending',
            'notes' => 'Permintaan pasang baru paket 50Mbps'
        ]);

        // Tugas Perbaikan untuk Zidan
        Task::create([
            'customer_id' => $c2->id,
            'technician_id' => $zidan->id,
            'task_type' => 'troubleshoot',
            'status' => 'on_progress',
            'notes' => 'User lapor internet mati/LOS Merah'
        ]);

        // Tugas Buka Isolir untuk Zahid
        Task::create([
            'customer_id' => $c3->id,
            'technician_id' => $zahid->id,
            'task_type' => 'buka_isolir',
            'status' => 'pending',
            'notes' => 'Sudah bayar, tolong aktifkan kembali di Winbox'
        ]);
    }
}