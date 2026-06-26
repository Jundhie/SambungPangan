<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- Pastikan ini di-import paling atas
use Carbon\Carbon; // Granular time helper

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 1. DATA HITUNGAN STAT CARDS (Sesuai ERD)
        $totalMitra = DB::table('mitra_kuliner')->count(); 
        $totalPengelola = DB::table('pengelola_pangan')->count();
        
        // Hitung total pending verifikasi dari gabungan kedua tabel detail
        $pendingMitra = DB::table('mitra_kuliner')->where('status_verifikasi', 'pending')->count();
        $pendingPengelola = DB::table('pengelola_pangan')->where('status_verifikasi', 'pending')->count();
        $totalPendingVerif = $pendingMitra + $pendingPengelola;
        
        // Hitung total limbah tersalurkan dari berat_barang di listing_limbah yang sudah masuk ke tabel TRANSAKSI
        $totalLimbahTersalurkan = DB::table('pesanan')
            ->join('listing_limbah', 'pesanan.id_listing', '=', 'listing_limbah.id_listing')
            ->where('pesanan.status_pesanan', 'selesai') // Asumsi data yang dihitung adalah yang sudah selesai
            ->sum('listing_limbah.berat_barang');

        // 2. LIST LIMBAH AKTIF (Sesuai ERD: LISTING_LIMBAH -> MITRA_KULINER & KATEGORI_LIMBAH)
        $limbahAktif = DB::table('listing_limbah')
            ->join('mitra_kuliner', 'listing_limbah.id_mitra', '=', 'mitra_kuliner.id_mitra')
            ->join('kategori_limbah', 'listing_limbah.id_kategori', '=', 'kategori_limbah.id_kategori')
            ->leftJoin('pesanan', 'listing_limbah.id_listing', '=', 'pesanan.id_listing')
            ->select(
                'mitra_kuliner.nama_usaha',
                'kategori_limbah.nama_kategori as kategori',
                'listing_limbah.berat_barang as berat',
                DB::raw("CASE 
                    WHEN pesanan.status_pesanan IS NULL THEN 'tersedia'
                    ELSE pesanan.status_pesanan 
                END as status")
            )
            ->orderBy('listing_limbah.id_listing', 'desc')
            ->take(4)
            ->get();

        // 3. ANTREAN VERIFIKASI PENDING (Gabungan MITRA_KULINER & PENGELOLA_PANGAN)
        $mitraPending = DB::table('mitra_kuliner')
            ->where('status_verifikasi', 'pending')
            ->select('nama_usaha', DB::raw("'Mitra Kuliner' as role_display"), 'jenis_usaha', 'created_at')
            ->get();

        $pengelolaPending = DB::table('pengelola_pangan')
            ->where('status_verifikasi', 'pending')
            ->select('nama_usaha', DB::raw("'Pengelola' as role_display"), 'jenis_pengelolaan as jenis_usaha', 'created_at')
            ->get();

        // Gabungkan antrean, urutkan tanggal terbaru, dan bungkus ke Carbon agar function di blade tidak error
        $verifPending = $mitraPending->merge($pengelolaPending)
            ->sortByDesc('created_at')
            ->take(3)
            ->map(function($item) {
                $item->created_at = Carbon::parse($item->created_at);
                return $item;
            });

        // 4. LOG AKTIVITAS (Sesuai ERD: LOG_AKTIVITAS -> USER)
        $logAktivitas = DB::table('log_aktivitas')
            ->join('users', 'log_aktivitas.id_user', '=', 'users.id_user')
            ->select('log_aktivitas.aksi', 'log_aktivitas.keterangan', 'log_aktivitas.created_at', 'users.nama as nama_user')
            ->orderBy('log_aktivitas.id_log', 'desc')
            ->take(10)
            ->get()
            ->map(function($item) {
                $item->created_at = Carbon::parse($item->created_at);
                // Kemas kalimat teks log secara dinamis sesuai struktur gambar
                $item->text_lengkap = "<strong>" . e($item->nama_user) . "</strong> " . e($item->aksi) . " " . e($item->keterangan);
                return $item;
            });

        // Lempar semua variabel ke Blade
        return view('admin.dashboard', compact(
            'totalMitra',
            'totalPengelola',
            'totalPendingVerif',
            'totalLimbahTersalurkan',
            'limbahAktif',
            'verifPending',
            'logAktivitas'
        ));
    }
}