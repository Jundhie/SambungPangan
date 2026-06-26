@extends('layouts.administrator')

@section('title', 'Log Aktivitas')

@section('content')

{{-- TOPBAR --}}
<div class="admin-topbar">
    <div>
        <div class="topbar-title">Log Aktivitas</div>
        <div class="topbar-subtitle">Riwayat seluruh aktivitas pengguna</div>
    </div>
</div>

{{-- INFO BANNER --}}
<div class="log-info-banner mb-3">
    <i class="bi bi-info-circle-fill log-info-icon"></i>
    <span>
        Data di halaman ini <strong>tidak dapat diubah atau dihapus</strong> oleh siapapun,
        termasuk admin — menjaga integritas riwayat aktivitas sistem.
    </span>
</div>

{{-- FILTER FORM --}}
<form method="GET" action="{{ route('admin.log') }}" id="filterForm">
    <div class="log-filter-row mb-3">

        {{-- Search --}}
        <div class="log-search-wrap">
            <i class="bi bi-search log-search-icon"></i>
            <input type="text"
                   name="search"
                   class="log-search-input"
                   placeholder="Cari nama pengguna atau keterangan..."
                   value="{{ request('search') }}"
                   onchange="document.getElementById('filterForm').submit()">
        </div>

        {{-- Filter Aksi --}}
        <select name="aksi" class="log-filter-select" onchange="document.getElementById('filterForm').submit()">
            <option value="semua" {{ request('aksi', 'semua') === 'semua' ? 'selected' : '' }}>Semua aksi</option>
            @foreach($daftarAksi as $aksi)
                <option value="{{ $aksi }}" {{ request('aksi') === $aksi ? 'selected' : '' }}>
                    {{ $aksi }}
                </option>
            @endforeach
        </select>

        {{-- Filter Role --}}
        <select name="role" class="log-filter-select" onchange="document.getElementById('filterForm').submit()">
            <option value="semua"            {{ request('role', 'semua') === 'semua'            ? 'selected' : '' }}>Semua role</option>
            <option value="administrator"    {{ request('role') === 'administrator'    ? 'selected' : '' }}>Admin</option>
            <option value="restoran"         {{ request('role') === 'restoran'         ? 'selected' : '' }}>Mitra Kuliner</option>
            <option value="pengelola_pangan" {{ request('role') === 'pengelola_pangan' ? 'selected' : '' }}>Pengelola Pangan</option>
        </select>

        {{-- Filter Waktu --}}
        <select name="waktu" class="log-filter-select" onchange="document.getElementById('filterForm').submit()">
            <option value="semua"      {{ request('waktu', 'semua') === 'semua'      ? 'selected' : '' }}>Semua waktu</option>
            <option value="hari_ini"   {{ request('waktu') === 'hari_ini'   ? 'selected' : '' }}>Hari ini</option>
            <option value="minggu_ini" {{ request('waktu') === 'minggu_ini' ? 'selected' : '' }}>Minggu ini</option>
            <option value="bulan_ini"  {{ request('waktu') === 'bulan_ini'  ? 'selected' : '' }}>Bulan ini</option>
        </select>

    </div>
</form>

{{-- TABLE HEADER --}}
<div class="row log-table-header px-2 mb-1">
    <div class="col-1 header-col">ID Log</div>
    <div class="col-2 header-col">Waktu</div>
    <div class="col-3 header-col">Pengguna</div>
    <div class="col-2 header-col">Aksi</div>
    <div class="col-4 header-col">Keterangan</div>
</div>

{{-- ROWS --}}
<div class="d-flex flex-column">
    @forelse($logs as $log)
        @php
            $user    = $log->user;
            $nama    = $user->nama ?? 'Pengguna';
            $role    = $user->role ?? '';
            $inisial = collect(explode(' ', $nama))
                ->take(2)
                ->map(fn($w) => strtoupper($w[0]))
                ->join('');

            $roleLabel = match($role) {
                'administrator'    => 'Admin',
                'restoran'         => 'Mitra Kuliner',
                'pengelola_pangan' => 'Pengelola Pangan',
                default            => ucfirst($role),
            };

            $avatarClass = match($role) {
                'administrator'    => 'log-avatar-admin',
                'restoran'         => 'log-avatar-mitra',
                'pengelola_pangan' => 'log-avatar-pengelola',
                default            => 'log-avatar-default',
            };

            $aksiClass = match(strtoupper($log->aksi)) {
                'LOGIN'             => 'log-badge-login',
                'BUAT LISTING'      => 'log-badge-listing',
                'BUAT PESANAN'      => 'log-badge-pesanan',
                'VERIFIKASI MITRA'  => 'log-badge-verifikasi',
                'KONFIRMASI PICKUP' => 'log-badge-pickup',
                'HAPUS LISTING'     => 'log-badge-hapus',
                default             => 'log-badge-default',
            };
        @endphp

        <div class="log-row">
            <div class="row align-items-center px-2 py-3">

                {{-- ID Log --}}
                <div class="col-1">
                    <span class="log-id">#{{ $log->id_log }}</span>
                </div>

                {{-- Waktu --}}
                <div class="col-2">
                    <div class="log-tanggal">{{ $log->waktu->format('d M Y') }}</div>
                    <div class="log-jam">{{ $log->waktu->format('H:i:s') }}</div>
                </div>

                {{-- Pengguna --}}
                <div class="col-3 d-flex align-items-center gap-2">
                    <div class="log-avatar {{ $avatarClass }}">{{ $inisial }}</div>
                    <div>
                        <div class="log-nama">{{ $nama }}</div>
                        <div class="log-role">{{ $roleLabel }}</div>
                    </div>
                </div>

                {{-- Aksi --}}
                <div class="col-2">
                    <span class="log-badge {{ $aksiClass }}">{{ $log->aksi }}</span>
                </div>

                {{-- Keterangan --}}
                <div class="col-4">
                    <span class="log-keterangan">{{ $log->keterangan ?? '-' }}</span>
                </div>

            </div>
            <hr class="kategori-divider">
        </div>
    @empty
        <div class="text-center py-5 text-muted">
            <i class="bi bi-journal-x fs-2 d-block mb-2"></i>
            Tidak ada log yang ditemukan.
        </div>
    @endforelse
</div>

{{-- PAGINATION --}}
@if($logs->hasPages())
<div class="d-flex align-items-center justify-content-between mt-3 pt-2">
    <div class="pagination-info">
        Menampilkan {{ $logs->firstItem() }}–{{ $logs->lastItem() }} dari {{ number_format($logs->total()) }} log
    </div>

    <div class="d-flex align-items-center gap-1">

        {{-- Sebelumnya --}}
        @if($logs->onFirstPage())
            <span class="btn-pagination-nav disabled">Sebelumnya</span>
        @else
            <a href="{{ $logs->previousPageUrl() }}" class="btn-pagination-nav">Sebelumnya</a>
        @endif

        {{-- Page numbers --}}
        @php
            $current = $logs->currentPage();
            $last    = $logs->lastPage();
            $pages   = [1];

            for ($p = max(2, $current - 1); $p <= min($last - 1, $current + 1); $p++) {
                $pages[] = $p;
            }

            if ($last > 1) $pages[] = $last;

            $pages = array_unique($pages);
            sort($pages);
        @endphp

        @php $prev = null; @endphp
        @foreach($pages as $page)
            @if($prev !== null && $page - $prev > 1)
                <span class="pagination-dots">...</span>
            @endif
            <a href="{{ $logs->url($page) }}"
               class="btn-pagination-num {{ $page === $current ? 'active' : '' }}">
                {{ $page }}
            </a>
            @php $prev = $page; @endphp
        @endforeach

        {{-- Berikutnya --}}
        @if($logs->hasMorePages())
            <a href="{{ $logs->nextPageUrl() }}" class="btn-pagination-nav">Berikutnya</a>
        @else
            <span class="btn-pagination-nav disabled">Berikutnya</span>
        @endif

    </div>
</div>
@endif

@endsection