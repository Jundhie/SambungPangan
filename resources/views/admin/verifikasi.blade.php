@extends('layouts.administrator')

@section('title', 'Manajemen User - Admin SambungPangan')

@section('content')

<div class="container-fluid py-4">
    <div class="mb-4">
        <h2 class="fw-bold text-dark mb-1">Verifikasi Mitra</h2>
        <p class="text-muted small">Tinjau dokumen dan setujui atau tolak pendaftaran mitra baru</p>
    </div>

    
    <h5 class="fw-semibold text-dark mb-3">Menunggu verifikasi ({{ $pendingCount }})</h5>

    <div class="d-flex flex-column gap-3 mb-4">
        @forelse($pendingMitra as $mitra)
            <div class="d-flex align-items-center justify-content-between p-3 bg-white border rounded-4 shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center" 
                         style="width: 48px; height: 48px; background-color: #c3eae4;">
                        <i class="bi bi-building text-teal" style="color: #0d9488;"></i>
                    </div>
                    
                    <div>
                        <h6 class="fw-bold text-dark mb-0">{{ $mitra->name }}</h6>
                        <span class="text-muted d-block small mb-1">
                            {{ $mitra->role === 'restoran' ? 'Restoran / Mitra' : 'Pengelola pakan' }}
                        </span>
                        <span class="text-secondary tracking-wide" style="font-size: 0.75rem;">
                            Diajukan {{ $mitra->created_at->translatedFormat('d F Y') }}
                        </span>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <span class="badge px-3 py-2 rounded-pill fw-semibold text-capitalize" 
                          style="background-color: #fef3c7; color: #d97706; font-size: 0.8rem;">
                        {{ $mitra->status_verifikasi }}
                    </span>
                    
                    <a href="{{ route('admin.verifikasi.show', $mitra->id_user) }}" class="text-dark btn btn-link p-0">
                        <i class="bi bi-chevron-right fw-bold fs-5"></i>
                    </a>
                </div>
            </div>
        @empty
            <div class="text-center py-5 bg-white border rounded-4">
                <p class="text-muted mb-0">Tidak ada pendaftaran mitra yang perlu diverifikasi.</p>
            </div>
        @endforelse
    </div>

    @if($pendingMitra->hasPages())
        <div class="d-flex justify-content-start align-items-center gap-2 mt-4 custom-pagination">
            {{-- Tombol Sebelumnya --}}
            @if ($pendingMitra->onFirstPage())
                <span class="btn btn-outline-secondary disabled rounded-3 px-3">Sebelumnya</span>
            @else
                <a href="{{ $pendingMitra->previousPageUrl() }}" class="btn btn-outline-teal rounded-3 px-3">Sebelumnya</a>
            @endif

            {{-- Angka Halaman --}}
            @foreach ($pendingMitra->getUrlRange(1, $pendingMitra->lastPage()) as $page => $url)
                @if ($page == $pendingMitra->currentPage())
                    <span class="btn btn-teal-active rounded-3 fw-bold">{{ $page }}</span>
                @else
                    {{-- Batasi tampilan angka jika terlalu banyak seperti di mockup (...) --}}
                    @if ($page == 2 || $page == 3 || $page == $pendingMitra->lastPage() || abs($page - $pendingMitra->currentPage()) <= 1)
                        <a href="{{ $url }}" class="btn btn-outline-page rounded-3">{{ $page }}</a>
                    @elseif ($page == 4 && $pendingMitra->lastPage() > 5)
                        <span class="px-2 text-muted">...</span>
                    @endif
                @endif
            @endforeach

            {{-- Tombol Berikutnya --}}
            @if ($pendingMitra->hasMorePages())
                <a href="{{ $pendingMitra->nextPageUrl() }}" class="btn btn-outline-teal rounded-3 px-3">Berikutnya</a>
            @else
                <span class="btn btn-outline-secondary disabled rounded-3 px-3">Berikutnya</span>
            @endif
        </div>
    @endif
</div>

@endsection