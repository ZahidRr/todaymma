<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inventory;

class InventorySeeder extends Seeder
{
    public function run(): void
    {
        // 1. MATERIAL (Dihitung secara kuantitas total)
        Inventory::create([
            'item_name' => 'Kabel UTP Cat6',
            'category' => 'material',
            'unit' => 'meter',
            'stock_quantity' => 1000
        ]);

        Inventory::create([
            'item_name' => 'Konektor RJ45',
            'category' => 'material',
            'unit' => 'pcs',
            'stock_quantity' => 100
        ]);

        // 2. PERANGKAT (Dihitung per Serial Number untuk tracking)
        for ($i = 1; $i <= 5; $i++) {
            Inventory::create([
                'item_name' => 'Router TP-Link TL-WR840N',
                'category' => 'perangkat',
                'serial_number' => 'SN-TPLINK-100' . $i,
                'status' => 'Tersedia',
                'unit' => 'pcs',
                'stock_quantity' => 1
            ]);
        }
    }
}