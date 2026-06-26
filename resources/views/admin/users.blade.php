@extends('layouts.administrator')

@section('title', 'Manajemen User - Admin SambungPangan')

@section('content')


<div class="container-fluid px-0">
    
    {{-- Header Halaman --}}
    <div class="management-header mb-4">
        <h1 class="page-title">Manajemen User</h1>
        <p class="page-subtitle">Data seluruh pengguna terdaftar</p>
        
        
    </div>

{{-- Filter Pills Atas (Kotak Rounded & Outline Hijau) --}}
    <div class="filter-pills-container d-flex flex-wrap gap-2 mb-3">
        <a href="?role=semua&status={{ $statusFilter ?? 'semua' }}&search={{ $search ?? '' }}" class="filter-pill {{ ($roleFilter ?? 'semua') == 'semua' ? 'active' : '' }}">
            Semua <span class="pill-count">({{ $counts['semua'] ?? 0 }})</span>
        </a>
        <a href="?role=mitra&status={{ $statusFilter ?? 'semua' }}&search={{ $search ?? '' }}" class="filter-pill {{ ($roleFilter ?? 'semua') == 'mitra' ? 'active' : '' }}">
            Mitra Kuliner <span class="pill-count">({{ $counts['mitra'] ?? 0 }})</span>
        </a>
        <a href="?role=pengelola&status={{ $statusFilter ?? 'semua' }}&search={{ $search ?? '' }}" class="filter-pill {{ ($roleFilter ?? 'semua') == 'pengelola' ? 'active' : '' }}">
            Pengelola Pangan <span class="pill-count">({{ $counts['pengelola'] ?? 0 }})</span>
        </a>
        <a href="?role=admin&status={{ $statusFilter ?? 'semua' }}&search={{ $search ?? '' }}" class="filter-pill {{ ($roleFilter ?? 'semua') == 'admin' ? 'active' : '' }}">
            Admin <span class="pill-count">({{ $counts['admin'] ?? 0 }})</span>
        </a>
    </div>

    {{-- Form Filter & Search Box --}}
    <form method="GET" action="{{ route('admin.users') }}" id="filterForm">
        <input type="hidden" name="role" value="{{ $roleFilter ?? 'semua' }}">

        <div class="search-filter-row mb-4">
            <div class="search-box-wrapper">
                <i class="bi bi-search search-icon"></i>
                <input type="text" name="search" class="form-control search-input" value="{{ $search ?? '' }}" placeholder="Cari nama atau email..." onchange="this.form.submit()">
            </div>
            <div class="dropdown-filter-wrapper">
                <select name="status" class="form-select status-select" onchange="this.form.submit()">
                    <option value="semua" {{ ($statusFilter ?? 'semua') == 'semua' ? 'selected' : '' }}>Semua Status</option>
                    <option value="disetujui" {{ ($statusFilter ?? 'semua') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="pending" {{ ($statusFilter ?? 'semua') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                    <option value="ditolak" {{ ($statusFilter ?? 'semua') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
        </div>
    </form>

    {{-- Tabel / List Pengguna --}}
    <div class="users-list-wrapper">
        {{-- Header Kolom --}}
        <div class="list-table-header d-none d-md-flex row mx-0 mb-2 px-4">
            <div class="col-md-4 header-col">Pengguna</div>
            <div class="col-md-2 header-col">Role</div>
            <div class="col-md-2 header-col">Telepon</div>
            <div class="col-md-2 header-col">Status Verifikasi</div>
            <div class="col-md-1 header-col">Terdaftar</div>
            <div class="col-md-1 header-col text-end">Aksi</div>
        </div>

{{-- Stack Baris Kartu User Loop --}}
        <div class="user-cards-stack">
            @forelse($users as $item)
            <div class="user-card-row row mx-0 align-items-center px-4 mb-3 py-2">
                <div class="col-md-4 col-12 my-1 d-flex align-items-center gap-3">
                    @php 
                        // Perbaikan: Pakai $item->nama (bukan name) sesuai kolom database lu
                        $namaUser = $item->nama ?? 'Tanpa Nama';
                        $words = explode(' ', trim($namaUser));
                        $inisial = count($words) >= 2 
                            ? strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1)) 
                            : strtoupper(substr($namaUser, 0, 2));

                        $colors = ['administrator'=>'#e0f2fe', 'restoran'=>'#e6f4ea', 'pengelola_pangan'=>'#ffedd5'];
                        $textColors = ['administrator'=>'#0369a1', 'restoran'=>'#0f766e', 'pengelola_pangan'=>'#c2410c'];
                        $bg = $colors[$item->role] ?? '#e2e8f0';
                        $tx = $textColors[$item->role] ?? '#334155';
                    @endphp
                    <div class="avatar-circle" style="background-color: {{ $bg }}; color: {{ $tx }}">
                        {{ $inisial }}
                    </div>
                    <div class="text-truncate">
                        <div class="user-name text-truncate">{{ $namaUser }}</div>
                        <div class="user-email text-truncate">{{ $item->email }}</div>
                    </div>
                </div>
                
                {{-- ... (Sisa kolom role, telepon, status, dll biarkan sama kayak kode lu sebelumnya) ... --}}
                <div class="col-md-2 col-6 my-1">
                    @if($item->role == 'administrator')
                        <span class="badge-role" style="background:#f1f5f9; color:#475569;">Admin</span>
                    @elseif($item->role == 'restoran')
                        <span class="badge-role role-mitra">Mitra Kuliner</span>
                    @else
                        <span class="badge-role role-pengelola">Pengelola Pangan</span>
                    @endif
                </div>
                <div class="col-md-2 col-6 my-1 text-muted-custom">
                    {{ $item->telepon ?? '-' }}
                </div>
                <div class="col-md-2 col-6 my-1">
                    @if($item->status_verifikasi == 'approved')
                        <span class="badge-status status-disetujui">Disetujui</span>
                    @elseif($item->status_verifikasi == 'pending')
                        <span class="badge-status status-menunggu">Menunggu</span>
                    @else
                        <span class="badge-status status-ditolak">Ditolak</span>
                    @endif
                </div>
                <div class="col-md-1 col-6 my-1 text-muted-custom">
                    {{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}
                </div>
                <div class="col-md-1 col-12 my-1 text-md-end text-start">
                    @if($item->status_verifikasi == 'pending')
                        <a href="{{ route('admin.verifikasi', ['id' => $item->id_user]) }}" class="action-link-btn" style="color: #d97706;">Verifikasi</a>
                    @else
                        <a href="{{ route('admin.users', ['view' => $item->id_user]) }}" class="action-link-btn">Lihat</a>
                    @endif
                </div>
            </div>
            @empty
            <div class="user-card-row p-5 text-center text-muted">
                <i class="bi bi-people mb-2 d-block" style="font-size: 2rem;"></i>
                Tidak ada data pengguna yang cocok dengan filter saat ini.
            </div>
            @endforelse
        </div>
    </div>

    {{-- Pagination Dinamis Custom (Navigasi Hijau & Angka Hitam/Mint) --}}
    @if($users->hasPages())
    <div class="pagination-wrapper d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3 mt-4 px-2">
        <div class="pagination-info">
            Menampilkan {{ $users->firstItem() ?? 0 }}-{{ $users->lastItem() ?? 0 }} dari {{ $users->total() }} pengguna
        </div>
        
        <div class="pagination-navigation d-flex align-items-center gap-2">
            {{-- Tombol Sebelumnya (Warna Hijau) --}}
            @if ($users->onFirstPage())
                <span class="btn-pagination-nav disabled">Sebelumnya</span>
            @else
                <a href="{{ $users->previousPageUrl() }}" class="btn-pagination-nav">Sebelumnya</a>
            @endif

            {{-- Generasi Angka Halaman (Warna Hitam / Mint Aktif) --}}
            @php
                $start = max($users->currentPage() - 2, 1);
                $end = min($start + 4, $users->lastPage());
                if ($end - $start < 4) {
                    $start = max($end - 4, 1);
                }
            @endphp

            @if ($start > 1)
                <a href="{{ $users->url(1) }}" class="btn-pagination-num">1</a>
                @if ($start > 2)
                    <span class="pagination-dots">...</span>
                @endif
            @endif

            @for ($i = $start; $i <= $end; $i++)
                @if ($i == $users->currentPage())
                    <span class="btn-pagination-num active">{{ $i }}</span>
                @else
                    <a href="{{ $users->url($i) }}" class="btn-pagination-num">{{ $i }}</a>
                @endif
            @endfor

            @if ($end < $users->lastPage())
                @if ($end < $users->lastPage() - 1)
                    <span class="pagination-dots">...</span>
                @endif
                <a href="{{ $users->url($users->lastPage()) }}" class="btn-pagination-num">{{ $users->lastPage() }}</a>
            @endif

            {{-- Tombol Berikutnya (Warna Hijau) --}}
            @if ($users->hasMorePages())
                <a href="{{ $users->nextPageUrl() }}" class="btn-pagination-nav">Berikutnya</a>
            @else
                <span class="btn-pagination-nav disabled">Berikutnya</span>
            @endif
        </div>
    </div>
    @endif

</div>
@endsection