@extends('layouts.administrator')

@section('title', 'Dashboard - Admin SambungPangan')

@push('styles')
    <style>
        /* Taruh CSS dari bagian bawah di sini atau di file terpisah */
    </style>
@endpush

@section('content')
<div class="container-fluid py-4 px-3 px-md-4">

    {{-- Topbar --}}
    <div class="d-flex justify-content-between align-items-start mb-4 pb-2">
        <div>
            <div class="text-dark fw-medium mb-1" style="font-size: 1rem;">Selamat Datang Kembali,</div>
            <h2 class="fw-bold text-dark mb-1" style="letter-spacing: -0.5px;">{{ auth()->user()->nama ?? 'Administrator' }}</h2>
            <div class="text-muted" style="font-size: 0.9rem;">Kelola platform SambungPangan dengan mudah dan efisien</div>
        </div>
        <div class="admin-pill-badge d-flex align-items-center">
            <div class="admin-avatar">AD</div>
            <span class="fw-bold text-dark" style="font-size: 0.9rem;">Admin</span>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-6 col-md-3">
            <div class="sp-card stat-card">
                <div class="stat-icon"><i class="bi bi-shop"></i></div>
                <div class="stat-num">{{ $totalMitra ?? 128 }}</div>
                <div class="stat-label">Mitra Kuliner Aktif</div>
                <div class="stat-trend trend-up">
                    <i class="bi bi-arrow-up-short"></i> 12% <span class="trend-text">dari bulan lalu</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="sp-card stat-card">
                <div class="stat-icon"><i class="bi bi-leaf"></i></div>
                <div class="stat-num">{{ $totalPengelola ?? 86 }}</div>
                <div class="stat-label">Pengelola Aktif</div>
                <div class="stat-trend trend-up">
                    <i class="bi bi-arrow-up-short"></i> 8% <span class="trend-text">dari bulan lalu</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="sp-card stat-card">
                <div class="stat-icon"><i class="bi bi-hourglass-split"></i></div>
                <div class="stat-num">{{ $totalPendingVerif ?? 7 }}</div>
                <div class="stat-label">Menunggu Verifikasi</div>
                <div class="stat-trend trend-down">
                    <i class="bi bi-arrow-down-short"></i> 3% <span class="trend-text">dari bulan lalu</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="sp-card stat-card">
                <div class="stat-icon"><i class="bi bi-recycle"></i></div>
                <div class="stat-num">{{ isset($totalLimbahTersalurkan) ? number_format($totalLimbahTersalurkan, 1, ',', '.') : '4,2' }}</div>
                <div class="stat-label">Limbah tersalurkan</div>
                <div class="stat-trend trend-up">
                    <i class="bi bi-arrow-up-short"></i> 15% <span class="trend-text">dari bulan lalu</span>
                </div>
            </div>
        </div>
    </div>

    {{-- List Limbah + Verifikasi --}}
    <div class="row g-4 mb-4">

        {{-- List Limbah Aktif --}}
        <div class="col-lg-7">
            <div class="sp-card h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0 text-dark">List Limbah Aktif</h5>
                    <a href="{{ route('admin.transaksi') }}" class="text-sp-green fw-bold text-decoration-none" style="font-size: 0.85rem;">Lihat semua</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless limbah-table mb-0">
                        <thead>
                            <tr>
                                <th>Mitra</th>
                                <th>Kategori</th>
                                <th>Berat</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($limbahAktif ?? [] as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        @if(Str::contains(Str::lower($item->kategori), 'nasi'))
                                            <div class="limbah-avatar bg-sp-green"><i class="bi bi-shop"></i></div>
                                        @elseif(Str::contains(Str::lower($item->kategori), 'sayur'))
                                            <div class="limbah-avatar bg-sp-orange"><i class="bi bi-bell-fill"></i></div>
                                        @elseif(Str::contains(Str::lower($item->kategori), 'roti'))
                                            <div class="limbah-avatar bg-sp-blue"><i class="bi bi-building"></i></div>
                                        @else
                                            <div class="limbah-avatar bg-sp-darkgreen"><i class="bi bi-person-fill"></i></div>
                                        @endif
                                        
                                        <div class="limbah-name text-dark">{{ $item->nama_usaha }}</div>
                                    </div>
                                </td>
                                <td>{{ $item->kategori }}</td>
                                <td>{{ $item->berat }} kg</td>
                                <td>
                                    @if($item->status == 'tersedia')
                                        <span class="badge sp-badge badge-tersedia">Tersedia</span>
                                    @elseif($item->status == 'dipesan')
                                        <span class="badge sp-badge badge-dipesan">Dipesan</span>
                                    @else
                                        <span class="badge sp-badge badge-selesai">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Belum ada limbah aktif saat ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Menunggu Verifikasi --}}
        <div class="col-lg-5">
            <div class="sp-card h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0 text-dark">Menunggu Verifikasi</h5>
                        <a href="{{ route('admin.verifikasi') }}" class="text-sp-green fw-bold text-decoration-none" style="font-size: 0.85rem;">Lihat semua</a>
                    </div>

                    @forelse($verifPending ?? [] as $mitra)
                    <div class="verif-item d-flex align-items-center gap-3 mb-4">
                        <div class="verif-icon sp-light-green-bg">
                            @if($mitra->role_display == 'Mitra Kuliner')
                                <i class="bi bi-shop text-dark fs-5"></i>
                            @else
                                <i class="bi bi-leaf text-dark fs-5"></i>
                            @endif
                        </div>
                        <div>
                            <div class="verif-name text-dark mb-1">{{ $mitra->nama_usaha }}</div>
                            <div class="verif-meta d-flex gap-2">
                                <span>{{ $mitra->role_display }}</span>
                                <span>{{ $mitra->jenis_usaha ?? 'Umum' }}</span>
                            </div>
                            <div class="verif-date mt-1">{{ $mitra->created_at->translatedFormat('d F Y') }}</div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-muted py-4">
                        Semua pengajuan mitra sudah diverifikasi!
                    </div>
                    @endforelse
                </div>

                <a href="{{ route('admin.verifikasi') }}" class="btn sp-btn-outline-green mt-3 w-100 py-2 fw-bold">Lihat semua permintaan &nbsp;→</a>
            </div>
        </div>

    </div>

{{-- Log Aktivitas Terbaru (Timeline Full dari Database) --}}
    <div class="row g-4">
        <div class="col-12">
            <div class="sp-card pb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0 text-dark">Log aktivitas terbaru</h5>
                    <a href="{{ route('admin.log') }}" class="text-sp-green fw-bold text-decoration-none" style="font-size: 0.85rem;">Lihat semua</a>
                </div>

                <div class="log-wrapper position-relative px-3 mt-4">
                    <!-- Garis Tengah -->
                    <div class="log-divider d-none d-md-block"></div>

                    <div class="row g-4">
                        @forelse($logAktivitas->chunk(5) as $index => $chunk)
                            <div class="col-md-6 {{ $index == 0 ? 'pe-md-5' : 'ps-md-5' }}">
                                
                                <div class="timeline-column">
                                    <!-- LOOPING DATA DARI DATABASE -->
                                    @foreach($chunk as $log)
                                    <div class="log-item">
                                        <div class="log-dot"></div>
                                        <div class="log-content">
                                            <div class="log-text">{!! $log->text_lengkap !!}</div>
                                            <div class="log-time">{{ $log->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                    @endforeach
                                    
                                </div>
                                
                            </div>
                        @empty
                            <div class="col-12 text-center text-muted py-4">Belum ada rekaman log aktivitas.</div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection