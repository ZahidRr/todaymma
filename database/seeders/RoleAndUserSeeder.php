<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash; // Wajib ada!

class RoleAndUserSeeder extends Seeder
{
    public function run(): void
    {
        $roleSales = Role::firstOrCreate(['name' => 'sales']);
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $roleTeknisi = Role::firstOrCreate(['name' => 'teknisi']);
        $roleManajemen = Role::firstOrCreate(['name' => 'manajemen']);

        // Akun Manajemen
        User::create([
            'name' => 'Manajemen MMA',
            'username' => 'MMA-GNR', 
            'password' => Hash::make('connectme!mma!'), 
        ])->assignRole($roleManajemen);

        // Akun Admin
        User::create([
            'name' => 'Mufarohah',
            'username' => 'mufarohah', 
            'password' => Hash::make('20051990'), 
        ])->assignRole($roleAdmin);

        // Akun Teknisi
        $dataTeknisi = [
            ['name' => 'Zahid Robbani', 'username' => 'zahid', 'dob' => '11301104'],
            ['name' => 'Zidan Ramdani', 'username' => 'zidan', 'dob' => '11021202'],
        ];

        foreach ($dataTeknisi as $t) {
            User::create([
                'name' => $t['name'],
                'username' => $t['username'],
                'password' => Hash::make($t['dob']), 
            ])->assignRole($roleTeknisi);
        }

        // Akun Sales
        $dataSales = [
            ['name' => 'Amanda', 'username' => 'amanda', 'dob' => '10101992'],
            ['name' => 'Ika Ariska', 'username' => 'ika', 'dob' => '11111993'],
            ['name' => 'Olivia', 'username' => 'olivia', 'dob' => '12121994'],
        ];

        foreach ($dataSales as $s) {
            User::create([
                'name' => $s['name'],
                'username' => $s['username'],
                'password' => Hash::make($s['dob']),
            ])->assignRole($roleSales);
        }
    }
}