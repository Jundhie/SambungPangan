@extends('layouts.administrator')

@section('title', 'Detail Transaksi #' . str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) . ' - Admin SambungPangan')

@section('content')

{{-- Topbar --}}
<div class="admin-topbar">
    <div>
        <a href="{{ route('admin.transaksi') }}" class="text-back d-inline-flex align-items-center gap-1 mb-2">
            <i class="bi bi-arrow-left"></i> Kembali ke daftar transaksi
        </a>
        <div class="topbar-title">Detail transaksi #{{ str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) }}</div>
        <div class="topbar-subtitle">Tinjau data seluruh transaksi</div>
    </div>
    <div class="topbar-user">
        <div class="topbar-avatar">AD</div>
        <span>Admin</span>
    </div>
</div>

{{-- Timeline --}}
<div class="admin-card mb-3">
    <div class="trx-timeline">
        @foreach($timeline as $i => $step)
            <div class="trx-timeline-step">
                <div class="trx-timeline-dot {{ $step['done'] ? 'done' : '' }}">
                    @if($step['done'])
                        <i class="bi bi-check-lg"></i>
                    @endif
                </div>
                <div class="trx-timeline-label">{{ $step['label'] }}</div>
                <div class="trx-timeline-time">
                    {{ $step['time'] ? \Carbon\Carbon::parse($step['time'])->format('d M, H:i') : '—' }}
                </div>
            </div>
            @if(!$loop->last)
                <div class="trx-timeline-line {{ $step['done'] ? 'done' : '' }}"></div>
            @endif
        @endforeach
    </div>
</div>

{{-- Mitra + Pengelola --}}
<div class="row g-3 mb-3">

    {{-- Mitra Kuliner --}}
    <div class="col-md-6">
        <div class="admin-card h-100">
            <div class="trx-detail-section-label">Mitra Kuliner</div>
            <div class="trx-detail-table-label">tabel: MITRA_KULINER</div>
            <div class="d-flex align-items-center gap-3 mt-3 mb-3">
                <div class="trx-detail-avatar" style="background:#d4f0e8; color:#1abc9c">
                    {{ strtoupper(substr($pesanan->nama_mitra ?? 'M', 0, 2)) }}
                </div>
                <div>
                    <div class="trx-detail-name">{{ $pesanan->nama_mitra ?? '-' }}</div>
                    <div class="trx-detail-sub">{{ ucfirst($pesanan->jenis_usaha ?? '') }} &nbsp;·&nbsp; {{ $pesanan->alamat_mitra ?? '-' }}</div>
                </div>
            </div>
            <div class="trx-detail-row">
                <span class="trx-detail-key">Kontak</span>
                <span class="trx-detail-val">{{ $pesanan->telepon_mitra ?? '-' }}</span>
            </div>
        </div>
    </div>

    {{-- Pengelola Pangan --}}
    <div class="col-md-6">
        <div class="admin-card h-100">
            <div class="trx-detail-section-label">Pengelola Pakan</div>
            <div class="trx-detail-table-label">tabel: PENGELOLA_PANGAN</div>
            <div class="d-flex align-items-center gap-3 mt-3 mb-3">
                <div class="trx-detail-avatar" style="background:#d4f0e8; color:#1abc9c">
                    {{ strtoupper(substr($pesanan->nama_pengelola ?? 'P', 0, 2)) }}
                </div>
                <div>
                    <div class="trx-detail-name">{{ $pesanan->nama_pengelola ?? '-' }}</div>
                    <div class="trx-detail-sub">{{ ucfirst($pesanan->jenis_pengelolaan ?? '') }} &nbsp;·&nbsp; {{ $pesanan->alamat_pengelola ?? '-' }}</div>
                </div>
            </div>
            <div class="trx-detail-row">
                <span class="trx-detail-key">Kontak</span>
                <span class="trx-detail-val">{{ $pesanan->telepon_pengelola ?? '-' }}</span>
            </div>
        </div>
    </div>

</div>

{{-- Detail Listing + Jadwal Pickup --}}
<div class="row g-3 mb-3">

    {{-- Detail Listing --}}
    <div class="col-md-6">
        <div class="admin-card h-100">
            <div class="trx-detail-section-label">Detail Listing</div>
            <div class="trx-detail-table-label">tabel: LISTING_LIMBAH</div>
            <div class="mt-3">
                <div class="trx-detail-row">
                    <div>
                        <div class="trx-detail-key">Kategori</div>
                        <div class="trx-detail-subkey">id_kategori</div>
                    </div>
                    <span class="trx-detail-val">{{ $pesanan->nama_kategori ?? '-' }}</span>
                </div>
                <div class="trx-detail-row">
                    <div>
                        <div class="trx-detail-key">Deskripsi</div>
                        <div class="trx-detail-subkey">deskripsi</div>
                    </div>
                    <span class="trx-detail-val">{{ $pesanan->deskripsi ?? '-' }}</span>
                </div>
                <div class="trx-detail-row">
                    <div>
                        <div class="trx-detail-key">Waktu Mulai</div>
                        <div class="trx-detail-subkey">created_at</div>
                    </div>
                    <span class="trx-detail-val">
                        {{ $pesanan->waktu_mulai ? \Carbon\Carbon::parse($pesanan->waktu_mulai)->format('d M, H:i') : '-' }}
                    </span>
                </div>
                <div class="trx-detail-row">
                    <div>
                        <div class="trx-detail-key">Waktu Selesai</div>
                        <div class="trx-detail-subkey">waktu_tersedia</div>
                    </div>
                    <span class="trx-detail-val">
                        {{ $pesanan->waktu_selesai ? \Carbon\Carbon::parse($pesanan->waktu_selesai)->format('d M, H:i') : '-' }}
                    </span>
                </div>
                <div class="trx-detail-row">
                    <div>
                        <div class="trx-detail-key">Harga</div>
                        <div class="trx-detail-subkey">harga</div>
                    </div>
                    <span class="trx-detail-val">
                        {{ $pesanan->harga ? 'Rp ' . number_format($pesanan->harga, 0, ',', '.') : 'Gratis' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Jadwal Pickup --}}
    <div class="col-md-6">
        <div class="admin-card h-100">
            <div class="trx-detail-section-label">Jadwal Pickup</div>
            <div class="trx-detail-table-label">tabel: JADWAL_PICKUP</div>
            <div class="mt-3">
                <div class="trx-detail-row">
                    <div>
                        <div class="trx-detail-key">Waktu Pickup</div>
                        <div class="trx-detail-subkey">waktu_pickup</div>
                    </div>
                    <span class="trx-detail-val">
                        {{ $jadwal?->waktu_pickup ? \Carbon\Carbon::parse($jadwal->waktu_pickup)->format('d M, H:i') : '—' }}
                    </span>
                </div>
                <div class="trx-detail-row">
                    <div>
                        <div class="trx-detail-key">Lokasi</div>
                        <div class="trx-detail-subkey">lokasi</div>
                    </div>
                    <span class="trx-detail-val">{{ $jadwal?->lokasi ?? '—' }}</span>
                </div>
                <div class="trx-detail-row">
                    <div>
                        <div class="trx-detail-key">Status Pickup</div>
                        <div class="trx-detail-subkey">status_pickup</div>
                    </div>
                    <span class="trx-detail-val">{{ ucfirst($jadwal?->status_pickup ?? '—') }}</span>
                </div>
                <div class="trx-detail-row">
                    <div>
                        <div class="trx-detail-key">Catatan</div>
                        <div class="trx-detail-subkey">catatan</div>
                    </div>
                    <span class="trx-detail-val">{{ $jadwal?->catatan ?? '—' }}</span>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Hasil Transaksi --}}
<div class="admin-card mb-3">
    <div class="trx-detail-section-label">Hasil Transaksi</div>
    <div class="trx-detail-table-label">tabel: TRANSAKSI</div>

    <div class="row g-3 mt-2">
        <div class="col-12 text-center">
            <div class="trx-hasil-num">
                {{ $pesanan->berat_barang ? $pesanan->berat_barang . ' KG' : '—' }}
            </div>
            <div class="trx-hasil-label">berat_barang (estimasi)</div>
        </div>
    </div>
</div>

{{-- Waktu Selesai + Bukti Pickup --}}
<div class="admin-card mb-3">
    <div class="trx-detail-row mb-2">
        <div>
            <div class="trx-detail-key">Waktu Selesai Transaksi</div>
            <div class="trx-detail-subkey">waktu_selesai</div>
        </div>
        <span class="trx-detail-val">
            {{ $pesanan->waktu_selesai
                ? \Carbon\Carbon::parse($pesanan->waktu_selesai)->format('d M, H:i')
                : '—' }}
        </span>
    </div>

    @if($pesanan->bukti_pickup)
        <div class="trx-detail-key mb-2">Bukti Pickup</div>
        <div class="trx-bukti-box d-flex align-items-center justify-content-between p-3 rounded-3">
            <div class="d-flex align-items-center gap-3">
                @php
                    $ext = pathinfo($pesanan->bukti_pickup, PATHINFO_EXTENSION);
                    $isImg = in_array(strtolower($ext), ['jpg','jpeg','png','webp']);
                @endphp
                @if($isImg)
                    <img src="{{ asset('storage/' . $pesanan->bukti_pickup) }}"
                         alt="Bukti Pickup"
                         style="width:52px; height:52px; object-fit:cover; border-radius:8px">
                @else
                    <i class="bi bi-file-earmark-pdf-fill text-danger" style="font-size:2.5rem"></i>
                @endif
                <div>
                    <div class="trx-detail-val" style="font-size:0.85rem">{{ basename($pesanan->bukti_pickup) }}</div>
                    <div class="trx-detail-subkey">{{ strtoupper($ext) }}</div>
                </div>
            </div>
            <a href="{{ asset('storage/' . $pesanan->bukti_pickup) }}"
               target="_blank"
               class="btn btn-sm d-flex align-items-center gap-1"
               style="border:1.5px solid #ddd; border-radius:8px; font-size:0.82rem; color:#555; padding:0.35rem 0.9rem">
                <i class="bi bi-eye"></i> Lihat Foto
            </a>
        </div>
    @endif
</div>

{{-- Tombol Aksi --}}
<div class="d-flex justify-content-between align-items-center mt-2 mb-4">
    <a href="{{ route('admin.transaksi') }}"
       class="btn btn-outline-secondary d-flex align-items-center gap-2"
       style="border-radius:8px; font-size:0.85rem; padding:0.5rem 1.2rem">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

    <form action="{{ route('admin.transaksi.destroy', $pesanan->id_pesanan) }}"
          method="POST"
          onsubmit="return confirm('Yakin ingin menghapus transaksi ini? Tindakan tidak dapat dibatalkan.')">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="btn btn-danger d-flex align-items-center gap-2"
                style="border-radius:8px; font-size:0.85rem; padding:0.5rem 1.2rem">
            <i class="bi bi-trash3"></i> Hapus Data
        </button>
    </form>
</div>

@endsection