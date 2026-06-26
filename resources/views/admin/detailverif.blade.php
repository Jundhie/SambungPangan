@extends('layouts.administrator')

@section('title', 'Manajemen User - Admin SambungPangan')

@section('content')
<div class="main-content">
    <!-- Tombol Kembali -->
    <div class="back-navigation mb-4">
        <a href="{{ route('admin.verifikasi') }}" class="text-decoration-none text-back">
            <i class="bi bi-arrow-left me-2"></i> Kembali Ke daftar
        </a>
    </div>

    <!-- Card Utama Detail -->
    <div class="card-detail-wrapper mb-4">
        <!-- Header Detail Profil -->
        <div class="detail-header-profile d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center gap-3">
                <!-- Avatar Inisial diambil dari Nama Usaha -->
                <div class="profile-avatar-circle d-flex align-items-center justify-content-center fw-bold fs-4">
                    {{ strtoupper(substr($detail->nama_usaha ?? $user->nama, 0, 2)) }}
                </div>
                <div>
                    <!-- Judul Utama: Nama Usaha dari tabel mitra/pengelola -->
                    <h4 class="profile-title mb-1">{{ $detail->nama_usaha ?? 'Nama Usaha Belum Diisi' }}</h4>
                    <div class="profile-subtitle text-muted fs-7">
                        <span class="text-capitalize">{{ $user->role === 'restoran' ? 'Mitra Kuliner' : 'Pengelola Pakan' }}</span>
                        <span class="mx-2">•</span>
                        <span>Diajukan {{ \Carbon\Carbon::parse($user->created_at)->translatedFormat('d F Y') }}</span>
                    </div>
                </div>
            </div>
            <span class="badge-status-pending text-capitalize">
                {{ $detail->status_verifikasi ?? 'Pending' }}
            </span>
        </div>

        <hr class="divider-line mb-4">

        <!-- Grid Data (USER & USAHA) -->
        <div class="row g-4 position-relative">
            
            <!-- Sisi Kiri: Data User -->
            <div class="col-md-6 custom-border-right">
                <h5 class="section-data-title mb-4">Data (USER)</h5>
                
                <div class="data-group mb-3">
                    <label class="data-label">Nama (USER)</label>
                    <p class="data-value">{{ $user->nama ?? '-' }}</p> 
                </div>

                <div class="data-group mb-3">
                    <label class="data-label">Email</label>
                    <p class="data-value">{{ $user->email ?? '-' }}</p>
                </div>

                <div class="data-group mb-3">
                    <label class="data-label">Telepon</label>
                    <p class="data-value">{{ $user->telepon ?? '-' }}</p>
                </div>

                <!-- Bagian Download Dokumen HANYA untuk Mitra Kuliner (restoran) -->
                @if($user->role === 'restoran')
                <div class="data-group mt-4">
                    <label class="data-label mb-2">Dokumen Izin Usaha</label>
                    <div class="document-download-box d-flex align-items-center justify-content-between p-3 border rounded-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-file-earmark-pdf-fill text-danger fs-3"></i>
                            <div>
                                <span class="d-block document-name text-truncate">
                                    {{ $detail->dokumen_izin ? basename($detail->dokumen_izin) : 'Tidak ada dokumen' }}
                                </span>
                            </div>
                        </div>
                        @if($detail->dokumen_izin)
                        <a href="{{ asset('storage/' . $detail->dokumen_izin) }}" class="text-dark fs-5" download>
                            <i class="bi bi-download"></i>
                        </a>
                        @endif
                    </div>
                </div>
                @endif
            </div>

            <!-- Sisi Kanan: Data Usaha -->
            <div class="col-md-6 ps-md-5">
                <h5 class="section-data-title mb-4">
                    Data Usaha ({{ $user->role === 'restoran' ? 'MITRA KULINER' : 'PENGELOLA PAKAN' }})
                </h5>

                <div class="data-group mb-3">
                    <label class="data-label">Nama Usaha</label>
                    <p class="data-value">{{ $detail->nama_usaha ?? '-' }}</p>
                </div>

                <div class="data-group mb-3">
                    <label class="data-label">Jenis Pengelolaan</label>
                    <!-- Dinamis berdasarkan role pendaftaran -->
                    <p class="data-value">
                        {{ $detail->jenis_pengelolaan ?? ($detail->jenis_usaha ?? '-') }}
                    </p>
                </div>

                <div class="data-group mb-3">
                    <label class="data-label">Alamat</label>
                    <p class="data-value">{{ $detail->alamat ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Tindakan Verifikasi & Catatan -->
    <!-- PERBAIKAN: Form bertumpuk sudah dibersihkan -->
    <form action="{{ route('admin.verifikasi.proses', $user->id_user) }}" method="POST" class="verification-action-form">
        @csrf
        <div class="card-comment-wrapper p-4 mb-4 border rounded-4 bg-white">
            <h5 class="section-data-title mb-3">Catatan Verifikasi (Opsional)</h5>
            <textarea name="catatan" class="form-control text-area-custom" rows="4" placeholder="Tambahkan catatan jika diperlukan, misalnya alasan penolakan.."></textarea>
        </div>

        <!-- Tombol Aksi di Pojok Kanan Bawah -->
        <div class="d-flex justify-content-end gap-3 mt-4">
            <button type="submit" name="status" value="ditolak" class="btn btn-action-tolak">Tolak</button>
            <button type="submit" name="status" value="disetujui" class="btn btn-action-setuju">Setujui</button>
        </div>
    </form>
</div>
@endsection