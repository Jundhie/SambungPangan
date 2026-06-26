<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- WAJIB TAMBAH INI

class UserController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil query string dari request filter halaman
        $roleFilter = $request->get('role', 'semua');
        $statusFilter = $request->get('status', 'semua');
        $search = $request->get('search', '');

        // 2. Base query data user (GABUNGKAN DENGAN TABEL ANAK UNTUK AMBIL STATUS)
        $baseQuery = User::select(
                'users.*',
                // Ambil status dari tabel anak. Kalau admin (nggak ada di tabel anak), default-nya jadikan 'approved'
                DB::raw("COALESCE(mitra_kuliner.status_verifikasi, pengelola_pangan.status_verifikasi, 'approved') as status_verifikasi")
            )
            ->leftJoin('mitra_kuliner', 'users.id_user', '=', 'mitra_kuliner.id_user')
            ->leftJoin('pengelola_pangan', 'users.id_user', '=', 'pengelola_pangan.id_user');

        // 3. Logic Search Box (Ganti jadi users.nama dan users.email biar spesifik)
        if (!empty($search)) {
            $baseQuery->where(function($q) use ($search) {
                $q->where('users.nama', 'LIKE', "%{$search}%")
                  ->orWhere('users.email', 'LIKE', "%{$search}%");
            });
        }

        // 4. Logic Filter Dropdown Status
        if ($statusFilter !== 'semua') {
            $baseQuery->where(function($q) use ($statusFilter) {
                $q->where('mitra_kuliner.status_verifikasi', $statusFilter)
                  ->orWhere('pengelola_pangan.status_verifikasi', $statusFilter)
                  // Khusus admin, hitung sebagai approved jika difilter
                  ->orWhereRaw("('$statusFilter' = 'approved' AND users.role = 'administrator')");
            });
        }

        // 5. Hitung jumlah data (Counts) untuk counter badge di atas tab role
        $counts = [
            'semua'     => (clone $baseQuery)->count(),
            'mitra'     => (clone $baseQuery)->where('users.role', 'restoran')->count(),
            'pengelola' => (clone $baseQuery)->where('users.role', 'pengelola_pangan')->count(),
            'admin'     => (clone $baseQuery)->where('users.role', 'administrator')->count(),
        ];

        // 6. Filter data utama berdasarkan tab role yang sedang aktif diklik
        if ($roleFilter !== 'semua') {
            $roleMapping = [
                'mitra'     => 'restoran',
                'pengelola' => 'pengelola_pangan',
                'admin'     => 'administrator'
            ];
            
            $dbRole = $roleMapping[$roleFilter] ?? $roleFilter;
            $baseQuery->where('users.role', $dbRole);
        }

        // 7. Ambil data dengan Pagination (10 data per halaman) -> Menghasilkan $users
        $users = $baseQuery->orderBy('users.created_at', 'desc')->paginate(10);

        // 8. Transformasi data singkat untuk Inisial Avatar Bulat
        $users->through(function($user) {
            // Perbaikan: pakai kolom $user->nama sesuai LRS
            $namaUser = $user->nama ?? 'Tanpa Nama';
            $words = explode(' ', trim($namaUser));
            
            if (count($words) >= 2) {
                $user->inisial = strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
            } else {
                $user->inisial = strtoupper(substr($namaUser, 0, 2));
            }

            $user->nama_tampilan = $namaUser; 
            
            return $user;
        });

        // 9. Lempar semua variabel ke view admin.users
        return view('admin.users', compact('users', 'roleFilter', 'statusFilter', 'search', 'counts'));
    }
}