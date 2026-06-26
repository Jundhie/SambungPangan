@extends('layouts.administrator')

@section('title', 'Kategori Limbah')

@section('content')

{{-- TOPBAR --}}
<div class="admin-topbar d-flex justify-content-between align-items-start mb-4">
    <div>
        <h2 class="fw-bold mb-1" style="font-size: 1.8rem; color: #111827;">Kategori Limbah</h2>
        <div class="text-muted" style="font-size: 0.85rem;">Master data tabel KATEGORI_LIMBAH</div>
    </div>
</div>

{{-- ALERT --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- Header row: tombol tambah --}}
<div class="d-flex justify-content-end mb-4">
    <a href="{{ route('admin.kategori.create') }}" class="btn text-white fw-semibold rounded-3 px-4 py-2" style="background-color: #1aa385; font-size: 0.9rem;">
        + Tambah kategori
    </a>
</div>

{{-- Table header --}}
<div class="row px-4 mb-3 fw-bold text-dark align-items-center" style="font-size: 0.95rem;">
    <div class="col-3">Nama Kategori</div>
    <div class="col-5">Deskripsi</div>
    <div class="col-2 text-center">Pemanfaatan</div>
    <div class="col-2 text-center">Aksi</div>
</div>

{{-- Rows (Diubah menjadi style Card Ber-Outline per baris) --}}
<div class="d-flex flex-column">
    @forelse($kategoris as $kategori)
        {{-- Setiap row dibungkus border, bg-white, dan margin-bottom (mb-3) --}}
        <div class="row align-items-center px-4 py-3 mb-3 border bg-white mx-0" style="border-color: #e5e7eb !important; border-radius: 12px; transition: box-shadow 0.2s;">
            
            {{-- Nama --}}
            <div class="col-3">
                <span class="fw-bold" style="font-size: 0.85rem; color: #111827;">{{ $kategori->nama_kategori }}</span>
            </div>

            {{-- Deskripsi --}}
            <div class="col-5">
                <span style="color: #4b5563; font-size: 0.85rem;">{{ $kategori->keterangan }}</span>
            </div>

            {{-- Pemanfaatan badge --}}
            <div class="col-2 text-center">
                @php
                    $peruntukan = strtolower(trim($kategori->peruntukan));
                    $bg = '#f3f4f6'; // default gray
                    $text = '#374151';

                    // Deteksi warna berdasarkan gambar: Pakan Ternak = Oranye, Kompos = Teal
                    if (str_contains($peruntukan, 'pakan ternak')) {
                        $bg = '#ffedd5'; 
                        $text = '#c2410c'; 
                    } elseif (str_contains($peruntukan, 'kompos')) {
                        $bg = '#a7f3d0'; 
                        $text = '#0f766e'; 
                    } elseif (str_contains($peruntukan, 'biogas')) {
                        $bg = '#dbeafe'; 
                        $text = '#1d4ed8'; 
                    }
                @endphp
                <span class="badge rounded-pill fw-medium px-3 py-2" style="background-color: {{ $bg }}; color: {{ $text }}; font-size: 0.72rem;">
                    {{ $kategori->peruntukan }}
                </span>
            </div>

            {{-- Aksi --}}
            <div class="col-2 text-center">
                <a href="{{ route('admin.kategori.edit', $kategori->id_kategori) }}"
                   class="text-decoration-none fw-bold" style="color: #1aa385; font-size: 0.9rem;">Edit</a>
            </div>
            
        </div>
    @empty
        <div class="text-center py-5 text-muted border rounded-3 bg-white" style="border-color: #e5e7eb !important;">
            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
            Belum ada data kategori limbah.
        </div>
    @endforelse
</div>

@endsection