<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Halaman Dashboard Utama Admin
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Manajemen Data Users
     */
    public function users()
    {
        return view('admin.users');
    }

    /**
     * Halaman Verifikasi Akun (Mitra & Pengelola)
     */
    public function verifikasi()
    {
        return view('admin.verifikasi');
    }

    /**
     * Riwayat atau Manajemen Transaksi
     */
    public function transaksi()
    {
        return view('admin.transaksi');
    }

    /**
     * Manajemen Kategori Pangan / Menu
     */
    public function kategori()
    {
        return view('admin.kategori');
    }

    /**
     * Halaman Laporan Sistem / Keuangan
     */
    public function laporan()
    {
        return view('admin.laporan');
    }

    /**
     * Log Aktivitas Sistem
     */
    public function log()
    {
        return view('admin.log');
    }
}