<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - SambungPangan')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/administrator.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>

<div class="admin-wrapper">

    {{-- ===== SIDEBAR ===== --}}
    <aside class="sidebar">

        {{-- Card Atas: Logo + Menu --}}
        <div class="sidebar-card-top">

            <div class="sidebar-logo">
                <img src="{{ asset('gambar/logo_bc.png') }}" alt="SambungPangan">
                <div class="sidebar-logo-name">SambungPangan</div>
                <div class="sidebar-logo-tagline">◈ WASTE TODAY, FEED TOMORROW ◈</div>
            </div>

            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard') }}"
                   class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-house-door-fill"></i> Dashboard
                </a>

                <div class="sidebar-section-title">Market Place</div>

                <a href="{{ route('admin.listing') }}"
                class="sidebar-link {{ request()->routeIs('admin.listing') ? 'active' : '' }}">
                    <i class="bi bi-search"></i> Listing Limbah
                </a>

                <div class="sidebar-section-title">Pengguna</div>

                <a href="{{ route('admin.users') }}"
                   class="sidebar-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Manajemen user
                </a>

                <a href="{{ route('admin.verifikasi') }}"
                   class="sidebar-link {{ request()->routeIs('admin.verifikasi*') ? 'active' : '' }}">
                    <i class="bi bi-shield-check"></i> Verifikasi mitra
                </a>

                <div class="sidebar-section-title">Operasional</div>

                <a href="{{ route('admin.transaksi') }}"
                   class="sidebar-link {{ request()->routeIs('admin.transaksi') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-check"></i> Pesanan
                </a>

                <a href="{{ route('admin.kategori') }}"
                   class="sidebar-link {{ request()->routeIs('admin.kategori') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark"></i> Kategori Limbah
                </a>

                <div class="sidebar-section-title">Laporan</div>

                <a href="{{ route('admin.kontak-masuk') }}"
                class="sidebar-link {{ request()->routeIs('admin.kontak-masuk') ? 'active' : '' }}">
                    <i class="bi bi-envelope"></i> Kontak Masuk
                </a>

                <a href="{{ route('admin.laporan') }}"
                   class="sidebar-link {{ request()->routeIs('admin.laporan') ? 'active' : '' }}">
                    <i class="bi bi-graph-up"></i> Laporan & Analisis
                </a>

                <a href="{{ route('admin.log') }}"
                   class="sidebar-link {{ request()->routeIs('admin.log') ? 'active' : '' }}">
                    <i class="bi bi-clock-history"></i> Log Aktivitas
                </a>
            </nav>
        </div>

        {{-- Card Bawah: Tombol Keluar --}}
        <div class="sidebar-card-bottom">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout-sp">Keluar</button>
            </form>
        </div>

    </aside>

    {{-- ===== MAIN ===== --}}
    <main class="admin-main">
        @yield('content')
    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>