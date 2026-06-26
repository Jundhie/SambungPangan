@extends('layouts.administrator')

@section('title', 'Kontak-Masuk')

@section('content')
<div class="container-fluid p-4">
    
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h3 class="fw-bold mb-1">Kontak masuk</h3>
            <p class="text-muted small mb-0">Data agregat dari seluruh transaksi platform</p>
        </div>
        <span class="badge bg-white text-dark border px-4 py-2 rounded-pill shadow-sm" style="font-size: 0.9rem;">
            Admin
        </span>
    </div>

    <div class="tabel-kontak-container">
        
        <div class="row text-center fw-bold mb-3 px-3" style="font-size: 0.9rem;">
            <div class="col-3">Nama</div>
            <div class="col-4">Email</div>
            <div class="col-5">Pesan Masuk</div>
        </div>

        @foreach($pesans as $pesan)
        <div class="row align-items-center mb-3 mx-0 baris-kontak">
            
            <div class="col-3 text-center fw-semibold" style="font-size: 0.85rem;">
                {{ $pesan->nama_lengkap }}
            </div>
            
            <div class="col-4 text-center text-dark" style="font-size: 0.85rem;">
                {{ $pesan->email }}
            </div>
            
            <div class="col-5">
                <div class="kotak-pesan position-relative">
                    {{ $pesan->pesan }}
                    
                    <div class="indikator-scroll position-absolute d-flex flex-column justify-content-between">
                        <span style="cursor: pointer;">^</span>
                        <span style="cursor: pointer; transform: rotate(180deg);">^</span>
                    </div>
                </div>
            </div>
            
        </div>
        @endforeach

        <div class="d-flex justify-content-end mt-4 custom-pagination">
            {{-- Pastikan lu udah setting Paginator::useBootstrap() di AppServiceProvider --}}
            {{ $pesans->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>
@endsection