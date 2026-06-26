<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SambungPangan')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/publik.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body class="bg-white">

    {{-- NAVBAR --}}
    <div class="navbar-wrapper">
        <nav class="navbar navbar-expand-lg navbar-publik px-3 px-lg-4">

            {{-- Brand --}}
            <a class="navbar-brand d-flex align-items-center gap-2 text-white fw-bold" href="{{ route('beranda') }}">
                <img src="{{ asset('gambar/logo_bc.png') }}" alt="Logo" class="navbar-logo">
                SambungPangan
            </a>

            {{-- Toggler --}}
            <button class="navbar-toggler border-0 shadow-none" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarPublik">
                <span class="navbar-toggler-icon" style="filter:invert(1)"></span>
            </button>

            {{-- Menu --}}
            <div class="collapse navbar-collapse" id="navbarPublik">
                <ul class="navbar-nav align-items-center gap-1 mb-2 mb-lg-0 ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white fw-semibold px-3 py-1 rounded-pill
                            {{ request()->routeIs('beranda') ? 'nav-active' : '' }}"
                           href="{{ route('beranda') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-semibold px-3 py-1 rounded-pill
                            {{ request()->routeIs('tentang') ? 'nav-active' : '' }}"
                           href="{{ route('tentang') }}">Tentang kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-semibold px-3 py-1 rounded-pill
                            {{ request()->routeIs('kontak') ? 'nav-active' : '' }}"
                           href="{{ route('kontak') }}">Kontak</a>
                    </li>
                    {{-- Login --}}
                    <li class="nav-item">
                        <a href="{{ route('login') }}"
                           class="nav-link text-white fw-semibold px-3 py-1 rounded-pill {{ request()->routeIs('login') ? 'nav-active' : '' }}">
                           Login
                        </a>
                    </li>
                    {{-- Register --}}
                    <li class="nav-item">
                        <a href="{{ route('register') }}"
                           class="nav-link text-white fw-semibold px-3 py-1 rounded-pill {{ request()->routeIs('register') ? 'nav-active' : '' }}">
                           Register
                        </a>
                    </li>
                </ul>
            </div>

        </nav>
    </div>
    {{-- END NAVBAR --}}

    <main>
        @yield('content')
    </main>

    <footer class="border-top mt-auto py-3 text-center text-muted" style="font-size:0.85rem">
        &copy; {{ date('Y') }} SambungPangan. Hak cipta dilindungi.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>