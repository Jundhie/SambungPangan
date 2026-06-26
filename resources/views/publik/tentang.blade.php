@extends('layouts.publik')

@section('title', 'Tentang Kami - SambungPangan')

@section('content')

{{-- ================================================================
     HERO
================================================================ --}}
<section class="py-5 bg-white">
    <div class="container">
        <div class="row align-items-center g-4">

            {{-- Kiri --}}
            <div class="col-lg-6">
                <h1 class="fw-black text-sp-green" style="font-size:clamp(2rem,5vw,2.8rem)">Tentang Kami</h1>
                <p class="fw-semibold text-muted mb-3">Mengenal Lebih dekat SambungPangan</p>
                <p class="text-secondary lh-lg" style="font-size:0.9rem">
                    SambungPangan adalah platform logistik food waste yang menghubungkan bisnis kuliner dengan
                    pengelola pakan ternak dan kompos organik — mengubah sisa makanan menjadi sumber daya yang
                    bernilai, bukan sekadar sampah yang dibuang.
                </p>
                <h2 class="fw-black mt-4" style="font-size:clamp(1.3rem,3vw,1.7rem); line-height:1.3">
                    Kami hadir untuk <span class="text-sp-green">memutuskan<br>rantai pemborosan pangan</span>
                </h2>
            </div>

            {{-- Kanan: Ilustrasi --}}
            <div class="col-lg-6 text-center">
                <img src="{{ asset('gambar/tentang_ilustrasi.png') }}"
                     alt="Ilustrasi Tentang SambungPangan"
                     class="img-fluid" style="max-height:380px; object-fit:contain">
            </div>

        </div>
    </div>
</section>


{{-- ================================================================
     VISI & MISI
================================================================ --}}
<section class="py-4 bg-white">
    <div class="container">
        <div class="row g-4">

            <div class="col-md-6">
                <div class="rounded-4 p-4 h-100" style="border: 2px solid var(--sp-teal); background:#fff">
                    <h3 class="fw-bold mb-3" style="font-size:1.15rem; color:var(--sp-teal)">Visi</h3>
                    <p class="mb-0 text-justify" style="font-size:0.88rem; line-height:1.7; color:#333; text-align:justify">
                        Menjadi platform logistik pangan terpercaya di Indonesia yang mewujudkan ekosistem
                        kuliner bebas limbah makanan secara berkelanjutan.
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="rounded-4 p-4 h-100" style="border: 2px solid var(--sp-teal); background:#fff">
                    <h3 class="fw-bold mb-3" style="font-size:1.15rem; color:var(--sp-teal)">Misi</h3>
                    <p class="mb-0" style="font-size:0.88rem; line-height:1.7; color:#333; text-align:justify">
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
<section class="py-5 bg-white">
    <div class="container">

        <h2 class="fw-black mb-4" style="font-size:1.5rem; color:var(--sp-teal)">Nilai Kami</h2>

        <div class="row g-4">

            <div class="col-md-6">
                <div class="rounded-4 p-4 h-100" style="background:#e8f5ef">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="nilai-icon"><i class="bi bi-arrow-repeat"></i></div>
                        <span class="fw-bold" style="font-size:0.95rem">Keberlanjutan</span>
                    </div>
                    <p class="mb-0" style="font-size:0.85rem; line-height:1.65; color:#333; text-align:justify">
                        Setiap keputusan kami mempertimbangkan dampak jangka panjang terhadap lingkungan
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="rounded-4 p-4 h-100" style="background:#e8f5ef">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="nilai-icon"><i class="bi bi-bar-chart-line"></i></div>
                        <span class="fw-bold" style="font-size:0.95rem">Transparansi</span>
                    </div>
                    <p class="mb-0" style="font-size:0.85rem; line-height:1.65; color:#333; text-align:justify">
                        Semua transaksi tercatat dan dapat diverifikasi oleh semua pihak yang terlibat
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="rounded-4 p-4 h-100" style="background:#e8f5ef">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="nilai-icon"><i class="bi bi-people"></i></div>
                        <span class="fw-bold" style="font-size:0.95rem">Kolaborasi</span>
                    </div>
                    <p class="mb-0" style="font-size:0.85rem; line-height:1.65; color:#333; text-align:justify">
                        Kami percaya solusi terbaik lahir dari kerja sama antar sektor yang saling mendukung
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="rounded-4 p-4 h-100" style="background:#e8f5ef">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="nilai-icon"><i class="bi bi-person-check"></i></div>
                        <span class="fw-bold" style="font-size:0.95rem">Inklusif</span>
                    </div>
                    <p class="mb-0" style="font-size:0.85rem; line-height:1.65; color:#333; text-align:justify">
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
<section class="py-5 bg-white">
    <div class="container">
        <div class="rounded-3 text-center py-5 px-4" style="background-color: var(--sp-green-dark)">
            <h3 class="fw-bold text-white mb-3" style="font-size:1.4rem">Bergabunglah Bersama Kami!</h3>
            <p class="text-white mb-4 mx-auto" style="font-size:0.92rem; opacity:0.9; max-width:520px; line-height:1.65">
                Jadilah bagian dari gerakan mengurangi limbah makanan dan menciptakan
                nilai guna nyata bagi masyarakat dan lingkungan.
            </p>
            <a href="{{ route('register') }}"
               class="btn bg-white fw-bold px-4 py-2 rounded-pill" style="color: var(--sp-green-dark)">
                Gabung Sekarang
            </a>
        </div>
    </div>
</section>

@endsection