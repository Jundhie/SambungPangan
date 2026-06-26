@extends('layouts.publik')

@section('title', 'Beranda - SambungPangan')

@section('content')

{{-- ================================================================
     HERO
================================================================ --}}
<section class="py-5 bg-white">
    <div class="container">
        <div class="row align-items-center g-4">

            {{-- Kiri --}}
            <div class="col-lg-6">
                {{-- Badge --}}
                <span class="badge-hero d-inline-block mb-3">
                    Selamat Datang di SambungPangan
                </span>

                {{-- Headline --}}
                <h1 class="hero-title fw-black lh-sm mb-3">
                    Salurkan Sisa<br>
                    Makanan<br>
                    Menjadi <span class="text-sp-green">Nilai Guna<br>Nyata</span>
                </h1>

                {{-- Desc --}}
                <p class="text-secondary lh-lg mb-4" style="font-size:0.95rem; max-width:480px">
                    SambungPangan hadir sebagai platform yang menghubungkan bisnis kuliner dengan
                    pengelola pakan ternak dan kompos organik — mengurangi limbah makanan sekaligus
                    menciptakan rantai manfaat yang berkelanjutan.
                </p>

                {{-- CTA --}}
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('register') }}" class="btn btn-sp-green rounded-pill px-4 py-2 fw-bold">
                        Mulai Bergabung &nbsp;→
                    </a>
                    <a href="#cara-kerja" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-semibold">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>

            {{-- Kanan: Ilustrasi --}}
            <div class="col-lg-6 text-center">
                <img src="{{ asset('gambar/beranda_ilustrasi.png') }}"
                     alt="Ilustrasi SambungPangan"
                     class="img-fluid" style="max-height:400px; object-fit:contain">
            </div>

        </div>
    </div>
</section>


{{-- ================================================================
     CARA KERJA
================================================================ --}}
<section class="py-5 bg-white" id="cara-kerja">
    <div class="container">

        <h2 class="text-center fw-bold mb-4" style="font-size:1.6rem">Cara Kerja Kami</h2>

        {{-- Tab Toggle --}}
        <div class="d-flex justify-content-center mb-5">
            <div class="ck-tab-group">
                <button class="ck-tab" id="tab-mitra" onclick="switchTab('mitra')">
                    Mitra Kuliner
                </button>
                <button class="ck-tab active" id="tab-pengelola" onclick="switchTab('pengelola')">
                    Pengelola Pakan/Kompos
                </button>
            </div>
        </div>

        {{-- Steps Mitra --}}
        <div id="steps-mitra" class="d-none">
            <div class="row justify-content-center align-items-start g-0">
                <div class="col-auto text-center ck-step">
                    <div class="ck-icon mx-auto mb-3"><i class="bi bi-house-door"></i></div>
                    <div class="fw-bold mb-1">1. Daftar</div>
                    <div class="ck-desc"><strong>Registrasi Usaha</strong><br>Buat akun dan Upload<br>dokumen izin usahamu</div>
                </div>
                <div class="col-auto ck-arrow">→</div>
                <div class="col-auto text-center ck-step">
                    <div class="ck-icon mx-auto mb-3"><i class="bi bi-file-earmark-text"></i></div>
                    <div class="fw-bold mb-1">2. Input Sisa</div>
                    <div class="ck-desc"><strong>Lapor Sisa Makanan</strong><br>Isi Jenis, Berat estimasi<br>dan waktu tersedia</div>
                </div>
                <div class="col-auto ck-arrow">→</div>
                <div class="col-auto text-center ck-step">
                    <div class="ck-icon mx-auto mb-3"><i class="bi bi-bell"></i></div>
                    <div class="fw-bold mb-1">3. Konfirmasi</div>
                    <div class="ck-desc"><strong>Terima Notifikasi</strong><br>Sistem mencocokkan<br>dengan Pengelola terdekat</div>
                </div>
                <div class="col-auto ck-arrow">→</div>
                <div class="col-auto text-center ck-step">
                    <div class="ck-icon mx-auto mb-3"><i class="bi bi-check2-square"></i></div>
                    <div class="fw-bold mb-1">4. Selesai</div>
                    <div class="ck-desc"><strong>Sisa Terangkut</strong><br>Limbah tersalurkan,<br>Riwayat tersimpan otomatis</div>
                </div>
            </div>
        </div>

        {{-- Steps Pengelola (default aktif) --}}
        <div id="steps-pengelola">
            <div class="row justify-content-center align-items-start g-0">
                <div class="col-auto text-center ck-step">
                    <div class="ck-icon mx-auto mb-3"><i class="bi bi-house-door"></i></div>
                    <div class="fw-bold mb-1">1. Daftar</div>
                    <div class="ck-desc"><strong>Registrasi Usaha</strong><br>Buat akun dan Upload<br>dokumen izin pengelolaan</div>
                </div>
                <div class="col-auto ck-arrow">→</div>
                <div class="col-auto text-center ck-step">
                    <div class="ck-icon mx-auto mb-3"><i class="bi bi-search"></i></div>
                    <div class="fw-bold mb-1">2. Telusuri</div>
                    <div class="ck-desc"><strong>Lihat Sisa Tersedia</strong><br>Cari listing dari mitra<br>kuliner di sekitar lokasimu</div>
                </div>
                <div class="col-auto ck-arrow">→</div>
                <div class="col-auto text-center ck-step">
                    <div class="ck-icon mx-auto mb-3"><i class="bi bi-cart3"></i></div>
                    <div class="fw-bold mb-1">3. Pesan</div>
                    <div class="ck-desc"><strong>Buat Pesanan</strong><br>Pilih listing dan<br>konfirmasi jadwal pickup</div>
                </div>
                <div class="col-auto ck-arrow">→</div>
                <div class="col-auto text-center ck-step">
                    <div class="ck-icon mx-auto mb-3"><i class="bi bi-truck"></i></div>
                    <div class="fw-bold mb-1">4. Ambil</div>
                    <div class="ck-desc"><strong>Lakukan Pickup</strong><br>Datang ke lokasi,<br>ambil, dan tandai selesai</div>
                </div>
            </div>
        </div>

    </div>
</section>


{{-- ================================================================
     STATISTIK
================================================================ --}}
<section class="py-4 pb-5 bg-white">
    <div class="container">
        <div class="row g-3 justify-content-center">
            <div class="col-6 col-md-3">
                <div class="stat-card text-center rounded-3 p-4">
                    <div class="stat-number fw-black">120+</div>
                    <div class="text-muted fw-semibold" style="font-size:0.88rem">Mitra Kuliner</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card text-center rounded-3 p-4">
                    <div class="stat-number fw-black">85+</div>
                    <div class="text-muted fw-semibold" style="font-size:0.88rem">Pengelola Aktif</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card text-center rounded-3 p-4">
                    <div class="stat-number fw-black">4.2 Ton</div>
                    <div class="text-muted fw-semibold" style="font-size:0.88rem">Limbah Tersalurkan</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card text-center rounded-3 p-4">
                    <div class="stat-number fw-black">12 Kota</div>
                    <div class="text-muted fw-semibold" style="font-size:0.88rem">Terjangkau</div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
function switchTab(tab) {
    const isMitra = tab === 'mitra';
    document.getElementById('steps-mitra').classList.toggle('d-none', !isMitra);
    document.getElementById('steps-pengelola').classList.toggle('d-none', isMitra);
    document.getElementById('tab-mitra').classList.toggle('active', isMitra);
    document.getElementById('tab-pengelola').classList.toggle('active', !isMitra);
}
</script>
@endpush