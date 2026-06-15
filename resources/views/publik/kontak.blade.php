@extends('layouts.publik')

@section('title', 'Kontak - SambungPangan')

@section('content')

<section class="kontak-section py-5">
    <div class="container">

        {{-- Header --}}
        <div class="text-center mb-5">
            <h1 class="kontak-title">Hubungi Kami</h1>
            <p class="kontak-subtitle">Kami siap membantu dan bekerja sama dengan Anda</p>
        </div>

        {{-- Card Utama --}}
        <div class="kontak-card">
            <div class="row g-0">

                {{-- Kiri: Informasi Kontak --}}
                <div class="col-5 kontak-info-col">

                    <h2 class="kontak-info-title">Informasi Kontak</h2>

                    <div class="kontak-info-item">
                        <div class="kontak-info-icon">
                            <i class="bi bi-building"></i>
                        </div>
                        <div>
                            <div class="kontak-info-label">Alamat</div>
                            <div class="kontak-info-text">
                                Universitas Bina Sarana Informatika<br>
                                Jl. Kramat Raya No.98, Kec. Senen,<br>
                                Kota Jakarta Pusat 10450
                            </div>
                        </div>
                    </div>

                    <div class="kontak-info-item">
                        <div class="kontak-info-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div>
                            <div class="kontak-info-label">Email</div>
                            <div class="kontak-info-text">media@sambungpangan.id</div>
                        </div>
                    </div>

                    <div class="kontak-info-item">
                        <div class="kontak-info-icon">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <div>
                            <div class="kontak-info-label">Telepon</div>
                            <div class="kontak-info-text">+62 813-1188-4566</div>
                        </div>
                    </div>

                    <div class="kontak-info-item">
                        <div class="kontak-info-icon">
                            <i class="bi bi-clock"></i>
                        </div>
                        <div>
                            <div class="kontak-info-label">Jam Operasional</div>
                            <div class="kontak-info-text">
                                Senin – Jumat<br>
                                08:00 – 17:00
                            </div>
                        </div>
                    </div>

                </div>


                {{-- Kanan: Form --}}
                <div class="col-7 kontak-form-col">

                    <h2 class="kontak-form-title">Kirim Pesan</h2>

                    @if(session('success'))
                        <div class="alert alert-success rounded-3 mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('kontak.kirim') }}" method="POST" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label class="kontak-form-label" for="nama">Nama Lengkap</label>
                            <input type="text"
                                   id="nama"
                                   name="nama"
                                   class="form-control kontak-input @error('nama') is-invalid @enderror"
                                   placeholder="Masukkan nama lengkap Anda"
                                   value="{{ old('nama') }}">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="kontak-form-label" for="email">Email</label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   class="form-control kontak-input @error('email') is-invalid @enderror"
                                   placeholder="Masukkan email Anda"
                                   value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="kontak-form-label" for="pesan">Pesan</label>
                            <textarea id="pesan"
                                      name="pesan"
                                      rows="5"
                                      class="form-control kontak-input @error('pesan') is-invalid @enderror"
                                      placeholder="Tulis pesan Anda disini...">{{ old('pesan') }}</textarea>
                            @error('pesan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-kirim-pesan">
                                Kirim Pesan
                            </button>
                        </div>

                    </form>

                </div>

            </div>
        </div>

    </div>
</section>

@endsection