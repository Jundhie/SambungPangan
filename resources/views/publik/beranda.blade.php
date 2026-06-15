@extends('layouts.publik')

@section('title', 'Beranda - SambungPangan')

@section('content')

{{-- ================================================================
     HERO SECTION
================================================================ --}}
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center min-vh-hero">

            {{-- Kiri: Teks --}}
            <div class="col-lg-6 hero-left">
                {{-- Badge --}}
                <span class="hero-badge mb-3 d-inline-block">
                    Selamat Datang di SambungPangan
                </span>

                {{-- Headline --}}
                <h1 class="hero-title">
                    Salurkan Sisa<br>
                    Makanan<br>
                    Menjadi <span class="hero-accent">Nilai Guna<br>Nyata</span>
                </h1>

                {{-- Deskripsi --}}
                <p class="hero-desc">
                    SambungPangan hadir sebagai platform yang menghubungkan bisnis kuliner
                    dengan pengelola pakan ternak dan kompos organik – mengurangi limbah
                    makanan sekaligus menciptakan rantai manfaat yang berkelanjutan.
                </p>

                {{-- CTA Buttons --}}
                <div class="hero-cta d-flex flex-wrap gap-3 mt-4">
                    <a href="{{ route('register') }}" class="btn btn-hero-primary">
                        Mulai Bergabung &nbsp;→
                    </a>
                    <a href="#cara-kerja" class="btn btn-hero-outline">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>

            {{-- Kanan: Ilustrasi --}}
            <div class="col-lg-6 hero-right text-center">
                <img src="{{ asset('gambar/beranda_ilustrasi.png') }}"
                        alt="Ilustrasi SambungPangan"
                        class="hero-img img-fluid">
            </div>

        </div>
    </div>
</section>


{{-- ================================================================
     CARA KERJA
================================================================ --}}
<section class="cara-kerja-section py-5" id="cara-kerja">
    <div class="container">

        <h2 class="text-center section-title mb-4">Cara Kerja Kami</h2>

        {{-- Tab Toggle --}}
        <div class="d-flex justify-content-center mb-5">
            <div class="ck-tab-group">
                <button class="ck-tab active" id="tab-mitra" onclick="switchTab('mitra')">
                    Mitra Kuliner
                </button>
                <button class="ck-tab" id="tab-pengelola" onclick="switchTab('pengelola')">
                    Pengelola Pakan/Kompos
                </button>
            </div>
        </div>

        {{-- Steps Mitra Kuliner --}}
        <div id="steps-mitra" class="ck-steps">
            <div class="row justify-content-center align-items-start g-0">

                <div class="col-auto ck-step-item">
                    <div class="ck-step-icon"><i class="bi bi-house-door"></i></div>
                    <div class="ck-step-num">1. Daftar</div>
                    <div class="ck-step-desc"><strong>Registrasi Usaha</strong><br>Buat akun dan Upload<br>dokumen izin usahamu</div>
                </div>

                <div class="col-auto ck-arrow">→</div>

                <div class="col-auto ck-step-item">
                    <div class="ck-step-icon"><i class="bi bi-file-earmark-text"></i></div>
                    <div class="ck-step-num">2. Input Sisa</div>
                    <div class="ck-step-desc"><strong>Lapor Sisa Makanan</strong><br>Isi Jenis, Berat estimasi<br>dan waktu tersedia</div>
                </div>

                <div class="col-auto ck-arrow">→</div>

                <div class="col-auto ck-step-item">
                    <div class="ck-step-icon"><i class="bi bi-bell"></i></div>
                    <div class="ck-step-num">3. Konfirmasi</div>
                    <div class="ck-step-desc"><strong>Terima Notifikasi</strong><br>Sistem mencocokkan<br>dengan Pengelola terdekat</div>
                </div>

                <div class="col-auto ck-arrow">→</div>

                <div class="col-auto ck-step-item">
                    <div class="ck-step-icon"><i class="bi bi-check2-square"></i></div>
                    <div class="ck-step-num">4. Selesai</div>
                    <div class="ck-step-desc"><strong>Sisa Terangkut</strong><br>Limbah tersalurkan,<br>Riwayat tersimpan otomatis</div>
                </div>

            </div>
        </div>

        {{-- Steps Pengelola (hidden default) --}}
        <div id="steps-pengelola" class="ck-steps d-none">
            <div class="row justify-content-center align-items-start g-0">

                <div class="col-auto ck-step-item">
                    <div class="ck-step-icon"><i class="bi bi-house-door"></i></div>
                    <div class="ck-step-num">1. Daftar</div>
                    <div class="ck-step-desc"><strong>Registrasi Usaha</strong><br>Buat akun dan Upload<br>dokumen izin pengelolaan</div>
                </div>

                <div class="col-auto ck-arrow">→</div>

                <div class="col-auto ck-step-item">
                    <div class="ck-step-icon"><i class="bi bi-search"></i></div>
                    <div class="ck-step-num">2. Telusuri</div>
                    <div class="ck-step-desc"><strong>Lihat Sisa Tersedia</strong><br>Cari listing dari mitra<br>kuliner di sekitar lokasimu</div>
                </div>

                <div class="col-auto ck-arrow">→</div>

                <div class="col-auto ck-step-item">
                    <div class="ck-step-icon"><i class="bi bi-cart3"></i></div>
                    <div class="ck-step-num">3. Pesan</div>
                    <div class="ck-step-desc"><strong>Buat Pesanan</strong><br>Pilih listing dan<br>konfirmasi jadwal pickup</div>
                </div>

                <div class="col-auto ck-arrow">→</div>

                <div class="col-auto ck-step-item">
                    <div class="ck-step-icon"><i class="bi bi-truck"></i></div>
                    <div class="ck-step-num">4. Ambil</div>
                    <div class="ck-step-desc"><strong>Lakukan Pickup</strong><br>Datang ke lokasi,<br>ambil, dan tandai selesai</div>
                </div>

            </div>
        </div>

    </div>
</section>


{{-- ================================================================
     STATISTIK
================================================================ --}}
<section class="stats-section py-4 pb-5">
    <div class="container">
        <div class="row g-3 justify-content-center">

            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-number">120+</div>
                    <div class="stat-label">Mitra Kuliner</div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-number">85+</div>
                    <div class="stat-label">Pengelola Aktif</div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-number">4.2 Ton</div>
                    <div class="stat-label">Limbah Tersalurkan</div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-number">12 Kota</div>
                    <div class="stat-label">Terjangkau</div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
function switchTab(tab) {
    const mitra     = document.getElementById('steps-mitra');
    const pengelola = document.getElementById('steps-pengelola');
    const tabMitra  = document.getElementById('tab-mitra');
    const tabPengelola = document.getElementById('tab-pengelola');

    if (tab === 'mitra') {
        mitra.classList.remove('d-none');
        pengelola.classList.add('d-none');
        tabMitra.classList.add('active');
        tabPengelola.classList.remove('active');
    } else {
        pengelola.classList.remove('d-none');
        mitra.classList.add('d-none');
        tabPengelola.classList.add('active');
        tabMitra.classList.remove('active');
    }
}
</script>
@endpush