@extends('layouts.publik')

@section('title', 'Login - SambungPangan')

@section('content')

<section class="login-section">
    <div class="container">
        <div class="row min-vh-login align-items-center">

            {{-- Kiri: Form --}}
            <div class="col-lg-6 login-form-col">

                <h1 class="login-title">Selamat Datang</h1>
                <p class="login-subtitle">Masuk untuk melanjutkan</p>

                @if(session('error'))
                    <div class="alert alert-danger rounded-3">{{ session('error') }}</div>
                @endif

                <form action="{{ route('login') }}" method="POST" novalidate class="mt-4">
                    @csrf

                    <div class="mb-4">
                        <label class="login-label" for="email">Email</label>
                        <input type="email"
                               id="email"
                               name="email"
                               class="form-control login-input @error('email') is-invalid @enderror"
                               placeholder="Masukkan email Anda"
                               value="{{ old('email') }}"
                               autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="login-label" for="password">Password</label>
                        <input type="password"
                               id="password"
                               name="password"
                               class="form-control login-input @error('password') is-invalid @enderror"
                               placeholder="Masukkan password Anda">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-end mb-4">
                        <a href="#" class="login-forgot">Lupa Password?</a>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-login-submit">Masuk</button>
                    </div>

                </form>

            </div>

            {{-- Kanan: Logo --}}
            <div class="col-lg-6 text-center login-logo-col">
                <img src="{{ asset('gambar/logo_bc.png') }}"
                     alt="SambungPangan"
                     class="login-logo img-fluid">
            </div>

        </div>
    </div>
</section>

@endsection