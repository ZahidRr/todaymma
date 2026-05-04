<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Urutan ini sangat penting!
        // Akun (Users) dibuat lebih dulu, baru inventory, lalu tugas.
        $this->call([
            RoleAndUserSeeder::class,
            InventorySeeder::class,
            CustomerTaskSeeder::class,
        ]);
    }
}