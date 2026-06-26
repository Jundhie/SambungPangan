@extends('layouts.publik')

@section('title', 'Kontak - SambungPangan')

@section('content')

<section class="py-5 bg-white">
    <div class="container">

        {{-- Header --}}
        <div class="text-center mb-5">
            <h1 class="fw-black" style="font-size:clamp(2rem,5vw,2.8rem); color:var(--sp-teal)">Hubungi Kami</h1>
            <p class="fw-semibold text-dark mt-2">Kami siap membantu dan bekerja sama dengan Anda</p>
        </div>

        {{-- Card Utama --}}
        <div class="row g-4 justify-content-center">

            {{-- Kiri: Informasi Kontak --}}
            <div class="col-md-5">
                <div class="rounded-4 p-4 h-100" style="border: 2px solid var(--sp-teal)">

                    <h2 class="fw-bold mb-4" style="font-size:1.3rem; color:var(--sp-teal)">Informasi Kontak</h2>

                    <div class="d-flex gap-3 mb-4">
                        <div class="kontak-icon"><i class="bi bi-building"></i></div>
                        <div>
                            <div class="fw-bold mb-1" style="font-size:0.9rem">Alamat</div>
                            <div class="text-secondary" style="font-size:0.85rem; line-height:1.6">
                                Universitas Bina Sarana Informatika<br>
                                Jl. Kramat Raya No.98, Kec. Senen,<br>
                                Kota Jakarta Pusat 10450
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mb-4">
                        <div class="kontak-icon"><i class="bi bi-envelope"></i></div>
                        <div>
                            <div class="fw-bold mb-1" style="font-size:0.9rem">Email</div>
                            <div class="text-secondary" style="font-size:0.85rem">media@sambungpangan.id</div>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mb-4">
                        <div class="kontak-icon"><i class="bi bi-telephone"></i></div>
                        <div>
                            <div class="fw-bold mb-1" style="font-size:0.9rem">Telepon</div>
                            <div class="text-secondary" style="font-size:0.85rem">+62 813-1188-4566</div>
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <div class="kontak-icon"><i class="bi bi-clock"></i></div>
                        <div>
                            <div class="fw-bold mb-1" style="font-size:0.9rem">Jam Operasional</div>
                            <div class="text-secondary" style="font-size:0.85rem; line-height:1.6">
                                Senin – Jumat<br>
                                08:00 – 17:00
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Kanan: Form --}}
            <div class="col-md-7">
                <div class="rounded-4 p-4 h-100" style="border: 2px solid var(--sp-teal)">

                    <h2 class="fw-bold mb-4" style="font-size:1.3rem; color:var(--sp-teal)">Kirim Pesan</h2>

                    @if(session('success'))
                        <div class="alert alert-success rounded-3">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('kontak.kirim') }}" method="POST" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label class="fw-bold mb-1 d-block" style="font-size:0.9rem">Nama Lengkap</label>
                            <input type="text" name="nama"
                                   class="form-control rounded-3 @error('nama') is-invalid @enderror"
                                   placeholder="Masukkan nama lengkap Anda"
                                   value="{{ old('nama') }}"
                                   style="border-color:#ccc; font-size:0.9rem">
                            @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold mb-1 d-block" style="font-size:0.9rem">Email</label>
                            <input type="email" name="email"
                                   class="form-control rounded-3 @error('email') is-invalid @enderror"
                                   placeholder="Masukkan email Anda"
                                   value="{{ old('email') }}"
                                   style="border-color:#ccc; font-size:0.9rem">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="fw-bold mb-1 d-block" style="font-size:0.9rem">Pesan</label>
                            <textarea name="pesan" rows="5"
                                      class="form-control rounded-3 @error('pesan') is-invalid @enderror"
                                      placeholder="Tulis pesan Anda disini..."
                                      style="border-color:#ccc; font-size:0.9rem; resize:none">{{ old('pesan') }}</textarea>
                            @error('pesan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn fw-bold py-2 rounded-3 text-white"
                                    style="background-color:var(--sp-green-dark); font-size:0.95rem">
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