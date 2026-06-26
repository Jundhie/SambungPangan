<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('pesanan')
            ->leftJoin('jadwal_pickup', 'pesanan.id_pesanan', '=', 'jadwal_pickup.id_pesanan')
            ->leftJoin('listing_limbah', 'pesanan.id_listing', '=', 'listing_limbah.id_listing')
            ->leftJoin('mitra_kuliner', 'listing_limbah.id_mitra', '=', 'mitra_kuliner.id_mitra')
            ->leftJoin('users as user_mitra', 'mitra_kuliner.id_user', '=', 'user_mitra.id_user')
            ->leftJoin('pengelola_pangan', 'pesanan.id_pengelola', '=', 'pengelola_pangan.id_pengelola')
            ->leftJoin('users as user_pengelola', 'pengelola_pangan.id_user', '=', 'user_pengelola.id_user')
            ->leftJoin('kategori_limbah', 'listing_limbah.id_kategori', '=', 'kategori_limbah.id_kategori')
// Di dalam method show($id) -> bagian select:
            ->select(
                'pesanan.id_pesanan',
                'pesanan.waktu_pesan',
                'pesanan.catatan',
                'pesanan.bukti_pickup',
                'pesanan.status_pesanan',
                'pesanan.updated_at',
                'listing_limbah.berat_barang',
                'listing_limbah.deskripsi',
                'pesanan.waktu_pesan as waktu_mulai',
                'pesanan.waktu_selesai',
                'listing_limbah.harga',
                'kategori_limbah.nama_kategori',
                'mitra_kuliner.nama_usaha as nama_mitra',
                'mitra_kuliner.alamat as alamat_mitra',
                'mitra_kuliner.jenis_usaha',
                'user_mitra.telepon as telepon_mitra',
                'user_mitra.email as email_mitra',
                'pengelola_pangan.nama_usaha as nama_pengelola',
                'pengelola_pangan.alamat as alamat_pengelola',
                'pengelola_pangan.jenis_pengelolaan',
                'user_pengelola.telepon as telepon_pengelola',
                'user_pengelola.email as email_pengelola',
                'jadwal_pickup.waktu_pickup', 
                'jadwal_pickup.status_pickup',
            )
            ->orderBy('pesanan.waktu_pesan', 'desc');

        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('pesanan.status_pesanan', $request->status);
        }

        if ($request->filled('search')) {
            $search = '%' . $request->search . '%';
            $query->where(function ($q) use ($search) {
                $q->where('mitra_kuliner.nama_usaha', 'like', $search)
                  ->orWhere('pengelola_pangan.nama_usaha', 'like', $search)
                  ->orWhere('user_mitra.email', 'like', $search)
                  ->orWhere('user_pengelola.email', 'like', $search);
            });
        }

        $transaksi = $query->paginate(5)->withQueryString();

        $stats = [
            'menunggu'   => DB::table('pesanan')->where('status_pesanan', 'pending')->count(),
            'berjalan'   => DB::table('pesanan')->where('status_pesanan', 'confirmed')->count(),
            'selesai'    => DB::table('pesanan')->where('status_pesanan', 'completed')->count(),
            'dibatalkan' => DB::table('pesanan')->where('status_pesanan', 'cancelled')->count(),
        ];

        // Mengambil kategori untuk filter
        $kategori = DB::table('listing_limbah')
            ->select('deskripsi')
            ->distinct()
            ->whereNotNull('deskripsi')
            ->pluck('deskripsi');

        return view('admin.transaksi', compact('transaksi', 'stats', 'kategori'));
    }

    public function show($id)
    {
        $pesanan = DB::table('pesanan')
            ->where('pesanan.id_pesanan', $id)
            ->leftJoin('listing_limbah', 'pesanan.id_listing', '=', 'listing_limbah.id_listing')
            ->leftJoin('kategori_limbah', 'listing_limbah.id_kategori', '=', 'kategori_limbah.id_kategori')
            ->leftJoin('mitra_kuliner', 'listing_limbah.id_mitra', '=', 'mitra_kuliner.id_mitra')
            ->leftJoin('users as user_mitra', 'mitra_kuliner.id_user', '=', 'user_mitra.id_user')
            ->leftJoin('pengelola_pangan', 'pesanan.id_pengelola', '=', 'pengelola_pangan.id_pengelola')
            ->leftJoin('users as user_pengelola', 'pengelola_pangan.id_user', '=', 'user_pengelola.id_user')
            ->select(
                'pesanan.id_pesanan',
                'pesanan.waktu_pesan',
                'pesanan.catatan',
                'pesanan.bukti_pickup',
                'pesanan.status_pesanan',
                'pesanan.updated_at',
                'listing_limbah.berat_barang',
                'listing_limbah.deskripsi',
                'pesanan.waktu_pesan as waktu_mulai',
                'pesanan.waktu_selesai',
                'listing_limbah.harga',
                'kategori_limbah.nama_kategori',
                'mitra_kuliner.nama_usaha as nama_mitra',
                'mitra_kuliner.alamat as alamat_mitra',
                'mitra_kuliner.jenis_usaha',
                'user_mitra.telepon as telepon_mitra',
                'user_mitra.telepon as telepon_mitra',
                'pengelola_pangan.nama_usaha as nama_pengelola',
                'pengelola_pangan.alamat as alamat_pengelola',
                'pengelola_pangan.jenis_pengelolaan',
                'user_pengelola.telepon as telepon_pengelola',
                'user_pengelola.email as email_pengelola',
            )
            ->first();

        abort_if(!$pesanan, 404, 'Transaksi tidak ditemukan.');

        $jadwal = DB::table('jadwal_pickup')->where('id_pesanan', $id)->first();

        $timeline = [
            ['label' => 'Pesanan dibuat', 'time' => $pesanan->waktu_pesan, 'done' => true],
            ['label' => 'Dikonfirmasi',   'time' => in_array($pesanan->status_pesanan, ['confirmed','completed']) ? $pesanan->waktu_pesan : null, 'done' => in_array($pesanan->status_pesanan, ['confirmed','completed'])],
            ['label' => 'Jadwal pickup',  'time' => $jadwal->waktu_pickup ?? null, 'done' => !is_null($jadwal)],
            ['label' => 'Selesai',        'time' => $pesanan->status_pesanan === 'completed' ? $pesanan->waktu_selesai : null, 'done' => $pesanan->status_pesanan === 'completed'],
        ];

        return view('admin.detailtransaksi', compact('pesanan', 'jadwal', 'timeline'));
    }

    public function destroy($id)
    {
        // Hapus jadwal pickup dulu (foreign key)
        DB::table('jadwal_pickup')->where('id_pesanan', $id)->delete();
        
        // Hapus pesanan
        DB::table('pesanan')->where('id_pesanan', $id)->delete();

        return redirect()->route('admin.transaksi')
            ->with('success', 'Transaksi #' . str_pad($id, 4, '0', STR_PAD_LEFT) . ' berhasil dihapus.');
    }
}