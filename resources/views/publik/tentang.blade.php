@extends('layouts.publik')

@section('title', 'Tentang Kami - SambungPangan')

@section('content')

{{-- ================================================================
     HERO TENTANG
================================================================ --}}
<section class="tentang-hero py-5">
    <div class="container">
        <div class="row align-items-center">

            {{-- Kiri: Judul --}}
            <div class="col-lg-5">
                <h1 class="tentang-hero-title">Tentang Kami</h1>
                <p class="tentang-hero-sub">Mengenal Lebih dekat SambungPangan</p>
            </div>

            {{-- Kanan: Ilustrasi --}}
            <div class="col-lg-7 text-center">
                <img src="{{ asset('gambar/tentang_ilustrasi.png') }}"
                     alt="Ilustrasi Tentang SambungPangan"
                     class="img-fluid tentang-hero-img">
            </div>

        </div>
    </div>
</section>


{{-- ================================================================
     TAGLINE + DESKRIPSI
================================================================ --}}
<section class="tentang-desc-section py-4">
    <div class="container">

        <h2 class="tentang-tagline">
            Kami hadir untuk <span class="tentang-tagline-accent">memutuskan<br>rantai pemborosan pangan</span>
        </h2>

        <p class="tentang-body mt-3">
            SambungPangan adalah platform logistik food waste yang menghubungkan bisnis kuliner dengan
            pengelola pakan ternak dan kompos organik — mengubah sisa makanan menjadi sumber daya yang
            bernilai, bukan sekadar sampah yang dibuang.
        </p>

    </div>
</section>


{{-- ================================================================
     VISI & MISI
================================================================ --}}
<section class="visi-misi-section py-4">
    <div class="container">
        <div class="row g-4">

            <div class="col-md-6">
                <div class="vm-card">
                    <h3 class="vm-title">Visi</h3>
                    <p class="vm-text">
                        Menjadi platform logistik pangan terpercaya di Indonesia yang mewujudkan
                        ekosistem kuliner bebas limbah makanan secara berkelanjutan.
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="vm-card">
                    <h3 class="vm-title">Misi</h3>
                    <p class="vm-text">
                        Menghubungkan bisnis kuliner dengan pengelola pangan melalui teknologi yang
                        efisien, transparan, dan mudah digunakan oleh semua kalangan.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- ================================================================
     NILAI KAMI
================================================================ --}}
<section class="nilai-section py-5">
    <div class="container">

        <h2 class="nilai-title mb-4">Nilai Kami</h2>

        <div class="row g-4">

            <div class="col-md-6">
                <div class="nilai-card">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <div class="nilai-icon"><i class="bi bi-arrow-repeat"></i></div>
                        <span class="nilai-label">Keberlanjutan</span>
                    </div>
                    <p class="nilai-text">
                        Setiap keputusan kami mempertimbangkan dampak jangka panjang terhadap lingkungan
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="nilai-card">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <div class="nilai-icon"><i class="bi bi-bar-chart-line"></i></div>
                        <span class="nilai-label">Transparansi</span>
                    </div>
                    <p class="nilai-text">
                        Semua transaksi tercatat dan dapat diverifikasi oleh semua pihak yang terlibat
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="nilai-card">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <div class="nilai-icon"><i class="bi bi-people"></i></div>
                        <span class="nilai-label">Kolaborasi</span>
                    </div>
                    <p class="nilai-text">
                        Kami percaya solusi terbaik lahir dari kerja sama antar sektor yang saling mendukung
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="nilai-card">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <div class="nilai-icon"><i class="bi bi-person-check"></i></div>
                        <span class="nilai-label">Inklusif</span>
                    </div>
                    <p class="nilai-text">
                        Platform dirancang mudah digunakan oleh semua kalangan, dari UMKM hingga perusahaan besar
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- ================================================================
     CTA BANNER
================================================================ --}}
<section class="tentang-cta-section py-5">
    <div class="container">
        <div class="tentang-cta-banner text-center">
            <h3 class="tentang-cta-title">Bergabunglah Bersama Kami!</h3>
            <p class="tentang-cta-desc">
                Jadilah bagian dari gerakan mengurangi limbah makanan dan menciptakan<br>
                nilai guna nyata bagi masyarakat dan lingkungan.
            </p>
            <a href="{{ route('register') }}" class="btn btn-cta-gabung mt-2">
                Gabung Sekarang
            </a>
        </div>
    </div>
</section>

@endsection