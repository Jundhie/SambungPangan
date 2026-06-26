<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\ListingLimbah;
use App\Models\MitraKuliner;
use App\Models\PengelolaPangan;
use App\Models\KategoriLimbah;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        // ── STAT CARDS ──────────────────────────────────────────

        // 1. Total limbah tersalurkan (kg → tampil ton)
        $totalLimbahKg = ListingLimbah::whereHas('pesanan', function ($q) {
            $q->where('status_pesanan', 'selesai');
        })->sum('berat_barang');
        $totalLimbahTon = round($totalLimbahKg / 1000, 1);

        // 2. Total transaksi
        $totalTransaksi = Pesanan::where('status_pesanan', 'selesai')->count();

        // 3. Rata-rata berat per transaksi (kg)
        $rataRata = $totalTransaksi > 0
            ? round($totalLimbahKg / $totalTransaksi, 1)
            : 0;

        // 4. Tingkat penyelesaian (%)
        $totalPesanan   = Pesanan::count();
        $pesananSelesai = Pesanan::where('status_pesanan', 'selesai')->count();
        $tingkatSelesai = $totalPesanan > 0
            ? round(($pesananSelesai / $totalPesanan) * 100)
            : 0;

        // ── CHART BAR: volume per minggu (5 minggu terakhir) ────
        $mingguData = [];
        for ($i = 4; $i >= 0; $i--) {
            $mulai  = Carbon::now()->subWeeks($i)->startOfWeek();
            $akhir  = Carbon::now()->subWeeks($i)->endOfWeek();
            $label  = 'Mg' . (5 - $i);

            $berat = ListingLimbah::whereHas('pesanan', function ($q) use ($mulai, $akhir) {
                $q->where('status_pesanan', 'selesai')
                  ->whereBetween('updated_at', [$mulai, $akhir]);
            })->sum('berat_barang');

            $mingguData[] = [
                'label' => $label,
                'berat' => (float) $berat,
            ];
        }

        // ── CHART DONUT: berdasarkan peruntukan ─────────────────
        $peruntukanData = KategoriLimbah::select('peruntukan', DB::raw('count(*) as total'))
            ->groupBy('peruntukan')
            ->get()
            ->map(fn($item) => [
                'label' => $item->peruntukan,
                'total' => (int) $item->total,
            ])
            ->values()
            ->toArray();

        // ── TABEL MITRA KULINER TERAKTIF ─────────────────────────
        $mitraAktif = MitraKuliner::select(
                'mitra_kuliner.id_mitra',
                'mitra_kuliner.nama_usaha',
                DB::raw('COUNT(DISTINCT listing_limbah.id_listing) as total_listing'),
                DB::raw('SUM(listing_limbah.berat_barang) as total_tersalurkan')
            )
            ->leftJoin('listing_limbah', 'listing_limbah.id_mitra', '=', 'mitra_kuliner.id_mitra')
            ->groupBy('mitra_kuliner.id_mitra', 'mitra_kuliner.nama_usaha')
            ->orderByDesc('total_tersalurkan')
            ->limit(4)
            ->get();

        // ── TABEL PENGELOLA PANGAN TERAKTIF ──────────────────────
        $pengelolaAktif = PengelolaPangan::select(
                'pengelola_pangan.id_pengelola',
                'pengelola_pangan.nama_usaha',
                DB::raw('COUNT(DISTINCT listing_limbah.id_listing) as total_listing'),
                DB::raw('SUM(listing_limbah.berat_barang) as total_tersalurkan')
            )
            ->leftJoin('pesanan', 'pesanan.id_pengelola', '=', 'pengelola_pangan.id_pengelola')
            ->leftJoin('listing_limbah', 'listing_limbah.id_listing', '=', 'pesanan.id_listing')
            ->groupBy('pengelola_pangan.id_pengelola', 'pengelola_pangan.nama_usaha')
            ->orderByDesc('total_tersalurkan')
            ->limit(4)
            ->get();

        return view('admin.laporan', compact(
            'totalLimbahTon',
            'totalTransaksi',
            'rataRata',
            'tingkatSelesai',
            'mingguData',
            'peruntukanData',
            'mitraAktif',
            'pengelolaAktif',
        ));
    }
}