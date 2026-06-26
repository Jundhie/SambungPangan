<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VerifikasiController extends Controller
{
    // 1. Halaman Utama: Daftar Antrean Verifikasi (Pending)
    public function index()
    {
        $pendingMitra = User::select(
                'users.*', 
                DB::raw('COALESCE(mitra_kuliner.status_verifikasi, pengelola_pangan.status_verifikasi) as status_verifikasi')
            )
            ->leftJoin('mitra_kuliner', 'users.id_user', '=', 'mitra_kuliner.id_user')
            ->leftJoin('pengelola_pangan', 'users.id_user', '=', 'pengelola_pangan.id_user')
            ->where(function($query) {
                $query->where(function($q) {
                    $q->where('users.role', 'restoran')
                      ->where('mitra_kuliner.status_verifikasi', 'pending');
                })->orWhere(function($q) {
                    $q->where('users.role', 'pengelola_pangan')
                      ->where('pengelola_pangan.status_verifikasi', 'pending');
                });
            })
            ->orderBy('users.created_at', 'desc')
            ->paginate(5);

        $pendingCount = User::leftJoin('mitra_kuliner', 'users.id_user', '=', 'mitra_kuliner.id_user')
            ->leftJoin('pengelola_pangan', 'users.id_user', '=', 'pengelola_pangan.id_user')
            ->where(function($query) {
                $query->where(function($q) {
                    $q->where('users.role', 'restoran')
                      ->where('mitra_kuliner.status_verifikasi', 'pending');
                })->orWhere(function($q) {
                    $q->where('users.role', 'pengelola_pangan')
                      ->where('pengelola_pangan.status_verifikasi', 'pending');
                });
            })
            ->count();

        return view('admin.verifikasi', compact('pendingMitra', 'pendingCount'));
    }

    // 2. Halaman Detail: Menampilkan data spesifik Mitra (Sesuai image_4300a6.png)
    public function show($id)
    {
        // Mengambil data user berdasarkan id_user
        $user = \App\Models\User::where('id_user', $id)->firstOrFail();

        // Mengambil detail tambahan sesuai role
        $detail = null;
        if ($user->role === 'restoran') {
            $detail = \DB::table('mitra_kuliner')->where('id_user', $id)->first();
        } elseif ($user->role === 'pengelola_pangan') {
            $detail = \DB::table('pengelola_pangan')->where('id_user', $id)->first();
        }

        // Pastikan $user dikirim ke view
        return view('admin.detailverif', compact('user', 'detail'));
    }

    // 3. Aksi Eksekusi: Proses Setuju atau Tolak
    public function proses(Request $request, $id)
    {
        $user = User::where('id_user', $id)->firstOrFail();
        $inputStatus = $request->input('status');
        $statusBaru = ($inputStatus === 'disetujui') ? 'approved' : 'rejected';

        if ($user->role === 'restoran') {
            DB::table('mitra_kuliner')->where('id_user', $id)->update([
                'status_verifikasi' => $statusBaru
            ]);
        } elseif ($user->role === 'pengelola_pangan') {
            DB::table('pengelola_pangan')->where('id_user', $id)->update([
                'status_verifikasi' => $statusBaru
            ]);
        }

        // Insert ke log_aktivitas
        DB::table('log_aktivitas')->insert([
            'id_user'    => $id,
            'waktu'      => now(),
            'aksi'       => $inputStatus === 'disetujui' ? 'Verifikasi Disetujui' : 'Verifikasi Ditolak',
            'keterangan' => 'Akun ' . $user->name . ' (' . $user->role . ') ' . ($inputStatus === 'disetujui' ? 'disetujui' : 'ditolak') . ' oleh admin.',
        ]);

        return redirect()->route('admin.verifikasi')->with('success', 'Status mitra berhasil diubah menjadi ' . $statusBaru);
    }
}