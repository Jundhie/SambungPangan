@extends('layouts.administrator')

@section('title', 'Tambah Kategori')

@section('content')

{{-- Back link + topbar --}}
<div class="admin-topbar">
    <div>
        <a href="{{ route('admin.kategori') }}" class="text-back d-flex align-items-center gap-1 mb-2">
            <i class="bi bi-arrow-left"></i> Kembali ke daftar kategori
        </a>
        <div class="topbar-title">Tambah Kategori</div>
        <div class="topbar-subtitle">Buat kategori limbah baru</div>
    </div>
    <div class="topbar-user">
        <div class="topbar-avatar"><i class="bi bi-person-fill"></i></div>
        {{ auth()->user()->name ?? 'Admin' }}
    </div>
</div>

{{-- Form card --}}
<div class="card-detail-wrapper">
    <form action="{{ route('admin.kategori.store') }}" method="POST">
        @csrf

        {{-- Nama Kategori --}}
        <div class="kategori-form-group">
            <label class="kategori-form-label">Nama Kategori</label>
            <input type="text"
                   name="nama_kategori"
                   class="kategori-form-input @error('nama_kategori') is-invalid @enderror"
                   placeholder="Misal : sisa kulit udang"
                   value="{{ old('nama_kategori') }}">
            @error('nama_kategori')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        {{-- Deskripsi --}}
        <div class="kategori-form-group">
            <label class="kategori-form-label">Deskripsi</label>
            <textarea name="keterangan"
                      class="kategori-form-textarea @error('keterangan') is-invalid @enderror"
                      placeholder="masukan kategori limbah"
                      rows="3">{{ old('keterangan') }}</textarea>
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
                    <option value="" disabled selected>Pilih pemanfaatan</option>
                    <option value="Pakan Ternak"    {{ old('peruntukan') === 'Pakan Ternak'    ? 'selected' : '' }}>Pakan Ternak</option>
                    <option value="Kompos"          {{ old('peruntukan') === 'Kompos'          ? 'selected' : '' }}>Kompos</option>
                    <option value="Kompos Organik"  {{ old('peruntukan') === 'Kompos Organik'  ? 'selected' : '' }}>Kompos Organik</option>
                    <option value="Biogas"          {{ old('peruntukan') === 'Biogas'          ? 'selected' : '' }}>Biogas</option>
                    <option value="Lainnya"         {{ old('peruntukan') === 'Lainnya'         ? 'selected' : '' }}>Lainnya</option>
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
                      rows="3">{{ old('deskripsi') }}</textarea>
        </div>

        {{-- Buttons --}}
        <div class="d-flex justify-content-end gap-2 mt-4">
            <button type="submit" class="btn-form-simpan">Simpan</button>
            <a href="{{ route('admin.kategori') }}" class="btn-form-batal">Batal</a>
        </div>

    </form>
</div>

@endsection