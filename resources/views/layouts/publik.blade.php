<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SambungPangan')</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    {{-- Custom CSS --}}
    <link href="{{ asset('css/publik.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body>

    {{-- ===== NAVBAR WRAPPER (untuk efek mengambang) ===== --}}
    <div class="navbar-wrapper">
        <nav class="navbar navbar-expand-lg navbar-publik">
            <div class="container-fluid px-3">

                {{-- Brand / Logo --}}
                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('beranda') }}">
                    <img src="{{ asset('gambar/logo_bc.png') }}" alt="Logo SambungPangan" class="navbar-logo">
                    <span class="brand-name">SambungPangan</span>
                </a>

                {{-- Toggler (mobile) --}}
                <button class="navbar-toggler border-0" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarPublik"
                        aria-controls="navbarPublik" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                {{-- Nav Items + Auth --}}
                <div class="collapse navbar-collapse justify-content-end" id="navbarPublik">
                    <ul class="navbar-nav align-items-center gap-lg-1 mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}"
                               href="{{ route('beranda') }}">
                                Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}"
                               href="{{ route('tentang') }}">
                                Tentang kami
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}"
                               href="{{ route('kontak') }}">
                                Kontak
                            </a>
                        </li>
                        <li class="nav-item ms-2">
                            <a href="{{ route('login') }}" class="btn btn-login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="btn btn-register">Register</a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>
    </div>
    {{-- ===== END NAVBAR ===== --}}

    {{-- ===== MAIN CONTENT ===== --}}
    <main>
        @yield('content')
    </main>
    {{-- ===== END MAIN CONTENT ===== --}}

    {{-- ===== FOOTER ===== --}}
    <footer class="footer-publik">
        <div class="container text-center py-3">
            <small>&copy; {{ date('Y') }} SambungPangan. Hak cipta dilindungi.</small>
        </div>
    </footer>
    {{-- ===== END FOOTER ===== --}}

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>