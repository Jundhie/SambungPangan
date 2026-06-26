<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(Request $request)
    {
        $query = LogAktivitas::with('user')
            ->orderByDesc('waktu');

        // Filter search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('keterangan', 'like', "%{$search}%")
                  ->orWhereHas('user', fn($u) => $u->where('nama', 'like', "%{$search}%"));
            });
        }

        // Filter aksi
        if ($request->filled('aksi') && $request->aksi !== 'semua') {
            $query->where('aksi', $request->aksi);
        }

        // Filter role
        if ($request->filled('role') && $request->role !== 'semua') {
            $query->whereHas('user', fn($u) => $u->where('role', $request->role));
        }

        // Filter waktu
        match ($request->waktu ?? 'semua') {
            'hari_ini'   => $query->whereDate('waktu', today()),
            'minggu_ini' => $query->whereBetween('waktu', [now()->startOfWeek(), now()->endOfWeek()]),
            'bulan_ini'  => $query->whereMonth('waktu', now()->month)->whereYear('waktu', now()->year),
            default      => null,
        };

        $logs = $query->paginate(10)->withQueryString();

        $daftarAksi = [
            'LOGIN', 'BUAT LISTING', 'BUAT PESANAN',
            'VERIFIKASI MITRA', 'KONFIRMASI PICKUP', 'HAPUS LISTING',
        ];

        return view('admin.log', compact('logs', 'daftarAksi'));
    }
}