<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DummySeeder extends Seeder
{
    public function run(): void
    {
        // 1. Users (ID 2 dan 3)
        DB::table('users')->insert([
            ['id_user' => 2, 'nama' => 'Mitra Resto', 'email' => 'mitra@sp.com', 'password' => Hash::make('password'), 'role' => 'restoran', 'telepon' => '08123'],
            ['id_user' => 3, 'nama' => 'Pengelola Hijau', 'email' => 'pengelola@sp.com', 'password' => Hash::make('password'), 'role' => 'pengelola_pangan', 'telepon' => '08124'],
        ]);

        // 2. Kategori
        DB::table('kategori_limbah')->insert([
            ['id_kategori' => 1, 'nama_kategori' => 'Sisa Dapur', 'keterangan' => 'Sisa sayur', 'peruntukan' => 'Kompos'],
        ]);

        // 3. Detail Peran (ID user disesuaikan dengan ID di atas: 2 dan 3)
        DB::table('mitra_kuliner')->insert([
            ['id_mitra' => 1, 'id_user' => 2, 'nama_usaha' => 'Resto Jaya', 'jenis_usaha' => 'restoran', 'alamat' => 'Jl. Merdeka 1', 'status_verifikasi' => 'approved'],
        ]);
        
        DB::table('pengelola_pangan')->insert([
            ['id_pengelola' => 1, 'id_user' => 3, 'nama_usaha' => 'Pengelola Hijau', 'jenis_pengelolaan' => 'kompos', 'alamat' => 'Jl. Hijau 10', 'status_verifikasi' => 'approved'],
        ]);

        // 4. Listing & Pesanan
        DB::table('listing_limbah')->insert([
            [
                'id_listing' => 1, 
                'id_mitra' => 1, 
                'id_kategori' => 1, 
                'berat_barang' => 10, 
                'harga' => 5000, 
                'status_listing' => 'Tersedia',
                'waktu_tersedia' => now() // <--- INI TAMBAHANNYA
            ],
        ]);

        DB::table('pesanan')->insert([
            ['id_pesanan' => 1, 'id_listing' => 1, 'id_pengelola' => 1, 'waktu_pesan' => now(), 'status_pesanan' => 'pending'],
        ]);
    }
}