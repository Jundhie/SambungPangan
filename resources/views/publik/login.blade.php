@extends('layouts.publik')

@section('title', 'Login - SambungPangan')

@section('content')

<section class="py-3 bg-white">
    <div class="container">
        <div class="row align-items-center min-vh-login">

            {{-- Kiri: Form --}}
            <div class="col-lg-6 pe-lg-5">

                <h1 class="fw-black mb-1" style="font-size:2rem; color:var(--sp-teal)">
                    Selamat Datang
                </h1>
                <p class="fw-bold text-dark mb-3">Masuk untuk melanjutkan</p>

                @if(session('error'))
                    <div class="alert alert-danger rounded-3">{{ session('error') }}</div>
                @endif

                <form action="{{ route('login') }}" method="POST" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label class="fw-bold d-block mb-1" style="font-size:0.9rem">Email</label>
                        <input type="email" name="email"
                               class="form-control rounded-3 @error('email') is-invalid @enderror"
                               placeholder="Masukkan email Anda"
                               value="{{ old('email') }}"
                               autofocus
                               style="border-color: var(--sp-teal); font-size:0.9rem; padding:0.45rem 0.85rem">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-0">
                        <label class="fw-bold d-block mb-1" style="font-size:0.9rem">Password</label>
                        <input type="password" name="password"
                               class="form-control rounded-3 @error('password') is-invalid @enderror"
                               placeholder="Masukkan password Anda"
                               style="border-color: var(--sp-teal); font-size:0.9rem; padding:0.45rem 0.85rem">
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="text-end mb-4">
                        <a href="#" style="font-size:0.88rem; color:var(--sp-teal); text-decoration:none">
                            Lupa Password?
                        </a>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn fw-bold py-2 rounded-3 text-white"
                                style="background-color:var(--sp-green-dark); font-size:0.97rem">
                            Masuk
                        </button>
                    </div>

                </form>

            </div>

            {{-- Kanan: Logo --}}
            <div class="col-lg-6 text-center mt-5 mt-lg-0">
                <img src="{{ asset('gambar/logo_bc.png') }}"
                     alt="SambungPangan"
                     class="img-fluid" style="max-width:600px">
            </div>

        </div>
    </div>
</section>

@endsection