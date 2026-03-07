<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin Profile
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password')
        ]);
        Service::create([
            'name' => 'Pendaftaran',
            'code' => 'A',
            'description' => 'Loket Pendaftaran Ulang & Baru'
        ]);

        Service::create([
            'name' => 'Pembayaran',
            'code' => 'B',
            'description' => 'Loket Pembayaran Kasir'
        ]);

        Service::create([
            'name' => 'Customer Service',
            'code' => 'C',
            'description' => 'Layanan Informasi dan Pengaduan'
        ]);
    }
}
