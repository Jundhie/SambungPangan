@extends('layouts.administrator')

@section('title', 'Transaksi - Admin SambungPangan')

@section('content')

{{-- Topbar --}}
<div class="admin-topbar">
    <div>
        <div class="topbar-title">Pantau Transaksi</div>
        <div class="topbar-subtitle">Tinjau data seluruh transaksi</div>
    </div>
</div>

{{-- Stat Cards --}}
<div class="row g-3 mb-4 align-items-stretch">
    <div class="col-6 col-md-3">
        <div class="stat-card-admin d-flex align-items-center gap-3">
            <div class="stat-icon-wrap mb-0"><i class="bi bi-clock"></i></div>
            <div>
                <div class="stat-num" style="font-size:1.6rem">{{ $stats['menunggu'] }}</div>
                <div class="stat-label-admin">Menunggu konfirmasi</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card-admin d-flex align-items-center gap-3">
            <div class="stat-icon-wrap mb-0"><i class="bi bi-truck"></i></div>
            <div>
                <div class="stat-num" style="font-size:1.6rem">{{ $stats['berjalan'] }}</div>
                <div class="stat-label-admin">Dikonfirmasi/berjalan</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card-admin d-flex align-items-center gap-3">
            <div class="stat-icon-wrap mb-0"><i class="bi bi-check-circle"></i></div>
            <div>
                <div class="stat-num" style="font-size:1.6rem">{{ $stats['selesai'] }}</div>
                <div class="stat-label-admin">Selesai bulan ini</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card-admin d-flex align-items-center gap-3">
            <div class="stat-icon-wrap mb-0" style="background:#fde8e8; color:#e53935"><i class="bi bi-x-circle"></i></div>
            <div>
                <div class="stat-num" style="font-size:1.6rem">{{ $stats['dibatalkan'] }}</div>
                <div class="stat-label-admin">Dibatalkan</div>
            </div>
        </div>
    </div>
</div>

{{-- Table Card --}}
<div class="admin-card">

    {{-- Filter Tabs --}}
    <div class="d-flex flex-wrap gap-2 mb-3">
        <a href="{{ request()->fullUrlWithQuery(['status' => 'semua']) }}"
           class="btn btn-tab {{ !request('status') || request('status') == 'semua' ? 'active' : '' }}">
            Semua
        </a>
        <a href="{{ request()->fullUrlWithQuery(['status' => 'pending']) }}"
           class="btn btn-tab {{ request('status') == 'pending' ? 'active' : '' }}">
            Menunggu
        </a>
        <a href="{{ request()->fullUrlWithQuery(['status' => 'confirmed']) }}"
           class="btn btn-tab {{ request('status') == 'confirmed' ? 'active' : '' }}">
            Dikonfirmasi
        </a>
        <a href="{{ request()->fullUrlWithQuery(['status' => 'completed']) }}"
           class="btn btn-tab {{ request('status') == 'completed' ? 'active' : '' }}">
            Selesai
        </a>
        <a href="{{ request()->fullUrlWithQuery(['status' => 'cancelled']) }}"
           class="btn btn-tab {{ request('status') == 'cancelled' ? 'active' : '' }}">
            Dibatalkan
        </a>
    </div>

    {{-- Search + Filter Kategori --}}
    <form method="GET" action="{{ route('admin.transaksi') }}" class="d-flex gap-2 mb-3">
        <input type="hidden" name="status" value="{{ request('status') }}">

        {{-- Search --}}
        <div class="input-group rounded-pill border flex-grow-1" style="border-color:#ddd !important; overflow:hidden; background:#fff;">
            <span class="input-group-text bg-white border-0 ps-3">
                <i class="bi bi-search text-muted" style="font-size:0.85rem;"></i>
            </span>
            <input type="text" name="search"
                class="form-control border-0 shadow-none"
                placeholder="Cari nama atau email..."
                value="{{ request('search') }}"
                style="font-size:0.83rem;">
        </div>

        {{-- Filter Kategori --}}
        <select name="kategori" class="form-select form-select-sm"
                style="width:auto; font-size:0.83rem; border: 1.5px solid var(--sp-teal); border-radius:20px; color:var(--sp-teal); white-space:nowrap;"
                onchange="this.form.submit()">
            <option value="">Semua Kategori</option>
            @foreach($kategori as $kat)
                <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>
                    {{ $kat }}
                </option>
            @endforeach
        </select>
    </form>

    {{-- Tabel --}}
    <div class="table-responsive">
        <table class="table trx-table align-middle mb-2">
            <thead>
                <tr>
                    <th>ID Pesanan</th>
                    <th>Mitra → Pengelola</th>
                    <th>Berat estimasi / aktual</th>
                    <th>Waktu Pesan</th>
                    <th>Jadwal Pickup</th>
                    <th>Status Pesanan</th>
                    <th>Status Pickup</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi as $trx)
                <tr>
                    <td class="fw-bold text-muted">#{{ str_pad($trx->id_pesanan, 4, '0', STR_PAD_LEFT) }}</td>
                    <td>
                        <div class="fw-semibold" style="font-size:0.83rem">{{ $trx->nama_mitra ?? '-' }}</div>
                        <div class="text-muted" style="font-size:0.75rem">{{ $trx->email_mitra ?? '-' }}</div>
                        @if(!empty($trx->nama_pengelola))
                            <div style="font-size:0.75rem; color:var(--sp-teal)">→ {{ $trx->nama_pengelola }}</div>
                        @endif
                    </td>
                    <td style="font-size:0.83rem">
                        {{ $trx->berat_barang ? $trx->berat_barang . ' kg' : '-' }}
                        <br><span class="text-muted" style="font-size:0.75rem">{{ $trx->nama_kategori ?? '' }}</span>
                    </td>
                    <td style="font-size:0.83rem">
                        {{ $trx->waktu_pesan ? \Carbon\Carbon::parse($trx->waktu_pesan)->format('d M, H.i') : '-' }}
                    </td>
                    <td style="font-size:0.83rem">
                        {{ $trx->waktu_pickup ? \Carbon\Carbon::parse($trx->waktu_pickup)->format('d M, H.i') : '—' }}
                    </td>
                    <td>
                        @php
                            $statusMap = [
                                'pending'   => ['label' => 'Menunggu',      'class' => 'menunggu'],
                                'confirmed' => ['label' => 'Dikonfirmasi',  'class' => 'dikonfirmasi'],
                                'completed' => ['label' => 'Selesai',       'class' => 'selesai'],
                                'cancelled' => ['label' => 'Batal',         'class' => 'batal'],
                            ];
                            $sp = $statusMap[$trx->status_pesanan] ?? ['label' => $trx->status_pesanan, 'class' => 'menunggu'];
                        @endphp
                        <span class="badge-trx {{ $sp['class'] }}">{{ $sp['label'] }}</span>
                    </td>
                    <td>
                        @php
                            $pickupMap = [
                                'belum_dijemput' => ['label' => 'Belum Dijemput', 'class' => 'belum'],
                                'terjadwal'      => ['label' => 'Terjadwal',      'class' => 'terjadwal'],
                                'selesai'        => ['label' => 'Selesai',        'class' => 'selesai'],
                            ];
                            $pk = $trx->status_pickup ? ($pickupMap[$trx->status_pickup] ?? ['label' => $trx->status_pickup, 'class' => 'belum']) : null;
                        @endphp
                        @if($pk)
                            <span class="badge-trx {{ $pk['class'] }}">{{ $pk['label'] }}</span>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td><a href="{{ route('admin.transaksi.show', $trx->id_pesanan) }}" class="trx-link">Detail</a></td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4" style="font-size:0.85rem">
                        Tidak ada data transaksi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex align-items-center justify-content-between mt-2 flex-wrap gap-2">
        <div class="text-muted" style="font-size:0.8rem">
            Menampilkan {{ $transaksi->firstItem() }}-{{ $transaksi->lastItem() }}
            dari {{ $transaksi->total() }} transaksi
        </div>
        <nav>
            <ul class="pagination pagination-sm mb-0 gap-1">
                {{-- Prev --}}
                <li class="page-item {{ $transaksi->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link rounded-2 border-0 text-muted"
                       href="{{ $transaksi->previousPageUrl() }}">Sebelumnya</a>
                </li>

                {{-- Halaman --}}
                @foreach($transaksi->getUrlRange(1, min(3, $transaksi->lastPage())) as $page => $url)
                    <li class="page-item {{ $transaksi->currentPage() == $page ? 'active' : '' }}">
                        <a class="page-link rounded-2 border-0" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                @if($transaksi->lastPage() > 3)
                    <li class="page-item disabled"><span class="page-link border-0 text-muted">...</span></li>
                    <li class="page-item {{ $transaksi->currentPage() == $transaksi->lastPage() ? 'active' : '' }}">
                        <a class="page-link rounded-2 border-0" href="{{ $transaksi->url($transaksi->lastPage()) }}">
                            {{ $transaksi->lastPage() }}
                        </a>
                    </li>
                @endif

                {{-- Next --}}
                <li class="page-item {{ !$transaksi->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link rounded-2 border-0 text-muted"
                       href="{{ $transaksi->nextPageUrl() }}">Berikutnya</a>
                </li>
            </ul>
        </nav>
    </div>

</div>

@endsection