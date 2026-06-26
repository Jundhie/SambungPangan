@extends('layouts.administrator')

@section('title', 'Listing Limbah')

@section('content')
<div class="container-fluid p-4">
    
    <div class="listing-header">
        <h3 class="fw-bold mb-1">Listing Limbah</h3>
        <p class="text-muted small mb-0">Temukan sisa makanan atau bahan yang bisa dimanfaatkan</p>
    </div>

    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h5 class="fw-bold mb-1">Listing Tersedia</h5>
            <p class="text-muted small mb-0">Menampilkan {{ $listings->firstItem() ?? 0 }}-{{ $listings->lastItem() ?? 0 }} dari {{ $listings->total() }} listing aktif</p>
        </div>
        
        <div class="d-flex gap-3 align-items-center">
            <form action="{{ route('admin.listing') }}" method="GET" class="position-relative">
                <input type="text" name="cari" class="form-control search-input pe-5" placeholder="Cari nama listing atau mitra..." value="{{ request('cari') }}" style="width: 300px;">
                <button type="submit" class="btn position-absolute top-50 end-0 translate-middle-y text-muted">
                    <i class="bi bi-search"></i>
                </button>
            </form>
            
            <select class="form-select search-input" style="width: 120px;">
                <option value="terbaru">Terbaru</option>
                <option value="terlama">Terlama</option>
            </select>
        </div>
    </div>

    <div class="row g-4">
        @foreach($listings as $listing)
        <div class="col-md-6 col-lg-3">
            <div class="card card-listing h-100 p-3">
                
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="icon-bulat">
                        <i class="bi bi-box-seam"></i> 
                    </div>
                    <span class="badge-kategori">{{ $listing->kategoriLimbah->nama_kategori ?? 'Umum' }}</span>
                </div>

                <h6 class="fw-bold mb-1 text-truncate" title="{{ $listing->deskripsi }}">{{ Str::limit($listing->deskripsi, 25) }}</h6>
                <p class="text-muted small mb-3 text-truncate">{{ $listing->mitraKuliner->nama_usaha ?? 'Mitra Tidak Diketahui' }}</p>

                <div class="d-flex justify-content-between mb-1 small">
                    <span class="text-muted">Berat</span>
                    <span class="fw-medium">{{ number_format($listing->berat_barang, 0) }}Kg</span>
                </div>
                <div class="d-flex justify-content-between mb-1 small">
                    <span class="text-muted">Harga</span>
                    @if($listing->harga == 0)
                        <span class="text-gratis">Gratis</span>
                    @else
                        <span class="text-success fw-medium">Rp. {{ number_format($listing->harga, 0, ',', '.') }}</span>
                    @endif
                </div>
                <div class="d-flex justify-content-between mb-3 small">
                    <span class="text-muted">Lokasi</span>
                    <span class="fw-medium text-truncate" style="max-width: 100px;">{{ $listing->mitraKuliner->alamat ?? '-' }}</span>
                </div>

                @php
                    $sekarang = \Carbon\Carbon::now();
                    $berakhir = \Carbon\Carbon::parse($listing->waktu_berakhir);
                    $sisaWaktu = $sekarang->diff($berakhir);
                @endphp
                
                <div class="mb-4">
                    @if($berakhir->isPast())
                        <span class="text-danger small fw-medium">Waktu habis</span>
                    @else
                        <span class="text-timer">Berakhir dalam {{ $sisaWaktu->h }}j {{ $sisaWaktu->i }} menit</span>
                    @endif
                </div>

                <div class="mt-auto d-flex gap-2">
                    <a href="#" class="btn btn-outline-custom w-50">Detail</a>
                    <form action="#" method="POST" class="w-50" onsubmit="return confirm('Yakin hapus listing ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-custom w-100">Hapus</button>
                    </form>
                </div>

            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="small text-muted">
            Menampilkan {{ $listings->firstItem() ?? 0 }}-{{ $listings->lastItem() ?? 0 }} dari {{ $listings->total() }} pengguna
        </div>
        <div class="custom-pagination">
            {{ $listings->links('pagination::bootstrap-5') }}
        </div>
    </div>

</div>
@endsection