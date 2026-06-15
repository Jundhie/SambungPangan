@extends('layouts.publik')

@section('title', 'Register | SambungPangan')

@section('content')

<div class="auth-page">

    <!-- LEFT PANEL -->
    <div class="auth-left">
        <div class="logo-icon">
            <img src="{{ asset('gambar/logo_bc.png') }}" alt="Logo SambungPangan">
        </div>
        <h2>Bergabung Bersama Kami</h2>
        <p>Daftarkan bisnis kuliner atau usaha pengelolaan pakan/komposmu dan mulai berkontribusi untuk lingkungan.</p>
        <span class="auth-tagline">Waste Today · Food Tomorrow</span>
    </div>

    <!-- RIGHT: FORM -->
    <div class="auth-right">
        <div class="auth-form-box">
            <h1>Buat Akun</h1>
            <p class="form-sub">Isi data berikut untuk mendaftar</p>

            @if($errors->any())
                <div class="alert alert-danger">
                    ⚠️ {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control"
                        placeholder="Masukkan nama lengkap Anda"
                        value="{{ old('name') }}"
                        required
                        autofocus
                    >
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        placeholder="Masukkan email Anda"
                        value="{{ old('email') }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="role">Tipe Akun</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="" disabled selected>Pilih tipe akun Anda</option>
                        <option value="mitra" {{ old('role') == 'mitra' ? 'selected' : '' }}>🍽️ Mitra Kuliner</option>
                        <option value="pengelola" {{ old('role') == 'pengelola' ? 'selected' : '' }}>🌾 Pengelola Pakan/Kompos</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Minimal 8 karakter"
                        required
                    >
                </div>

                <div class="form-group" style="margin-bottom: 24px;">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="Ulangi password Anda"
                        required
                    >
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center;">
                    Daftar Sekarang
                </button>
            </form>

            <div class="auth-footer-link">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
            </div>
        </div>
    </div>

</div>

@endsection