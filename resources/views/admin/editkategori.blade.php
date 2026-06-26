@extends('layouts.administrator')

@section('title', 'Edit Kategori')

@section('content')

{{-- Back link + topbar --}}
<div class="admin-topbar">
    <div>
        <a href="{{ route('admin.kategori') }}" class="text-back d-flex align-items-center gap-1 mb-2">
            <i class="bi bi-arrow-left"></i> Kembali ke daftar kategori
        </a>
        <div class="topbar-title">Edit Kategori</div>
        <div class="topbar-subtitle">Ubah data kategori limbah</div>
    </div>
    <div class="topbar-user">
        <div class="topbar-avatar"><i class="bi bi-person-fill"></i></div>
        {{ auth()->user()->name ?? 'Admin' }}
    </div>
</div>

{{-- Form card --}}
<div class="card-detail-wrapper">
    <form action="{{ route('admin.kategori.update', $kategori->id_kategori) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Nama Kategori --}}
        <div class="kategori-form-group">
            <label class="kategori-form-label">Nama Kategori</label>
            <input type="text"
                   name="nama_kategori"
                   class="kategori-form-input @error('nama_kategori') is-invalid @enderror"
                   placeholder="Sisa nasi/ makanan matang"
                   value="{{ old('nama_kategori', $kategori->nama_kategori) }}">
            @error('nama_kategori')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        {{-- Deskripsi --}}
        <div class="kategori-form-group">
            <label class="kategori-form-label">Deskripsi</label>
            <textarea name="keterangan"
                      class="kategori-form-textarea @error('keterangan') is-invalid @enderror"
                      rows="3">{{ old('keterangan', $kategori->keterangan) }}</textarea>
            @error('keterangan')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        {{-- Pemanfaatan --}}
        <div class="kategori-form-group">
            <label class="kategori-form-label">Pemanfaatan</label>
            <div class="kategori-select-wrapper">
                <select name="peruntukan"
                        class="kategori-form-select @error('peruntukan') is-invalid @enderror">
                    <option value="" disabled>Pilih pemanfaatan</option>
                    @foreach(['Pakan Ternak', 'Kompos', 'Kompos Organik', 'Biogas', 'Lainnya'] as $opt)
                        <option value="{{ $opt }}"
                            {{ old('peruntukan', $kategori->peruntukan) === $opt ? 'selected' : '' }}>
                            {{ $opt }}
                        </option>
                    @endforeach
                </select>
                <span class="kategori-select-chevron">V</span>
            </div>
            @error('peruntukan')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        {{-- Keterangan (opsional) --}}
        <div class="kategori-form-group">
            <label class="kategori-form-label">Keterangan <span class="text-muted fw-normal">(opsional)</span></label>
            <textarea name="deskripsi"
                      class="kategori-form-textarea"
                      placeholder="Penjelasan tambahan tentang kategori ini..."
                      rows="3">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
        </div>

        {{-- Buttons --}}
        <div class="d-flex justify-content-end gap-2 mt-4">
            
            {{-- Tombol Hapus hanya muncul jika ini halaman Edit (ada data $kategori) --}}
            @if(isset($kategori))
                <form action="{{ route('admin.kategori.destroy', $kategori->id_kategori) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-form-hapus">Hapus</button>
                </form>
            @endif

            <button type="submit" class="btn-form-simpan">Simpan</button>

            <a href="{{ route('admin.kategori') }}" class="btn-form-batal">Batal</a>
            
        </div>

    </form>
</div>

@endsection