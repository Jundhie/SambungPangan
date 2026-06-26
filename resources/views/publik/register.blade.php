@extends('layouts.publik')

@section('title', 'Register - SambungPangan')

@section('content')

<section class="py-4 bg-white" style="min-height:calc(100vh - 80px)">
    <div class="container" style="max-width:520px">

        {{-- Logo --}}
        <div class="text-center mb-3">
            <img src="{{ asset('gambar/logo_bc.png') }}" alt="SambungPangan" style="max-height:100px">
        </div>

        {{-- ================================================
             TAHAP 1 — Pilih Peran
        ================================================ --}}
        <div id="step-1">
            <h2 class="fw-black text-center mb-1" style="font-size:1.7rem; color:var(--sp-teal)">Bergabung Bersama</h2>
            <p class="text-center text-muted fw-semibold mb-3" style="font-size:0.9rem">Buat akun untuk memulai</p>

            {{-- Step indicator --}}
            <div class="d-flex justify-content-center align-items-center gap-2 mb-4">
                <div class="step-dot active">1</div>
                <span class="text-muted">→</span>
                <div class="step-dot">2</div>
                <span class="text-muted">→</span>
                <div class="step-dot">3</div>
            </div>

            {{-- Pilih Peran --}}
            <div class="border rounded-3 p-3 mb-3" style="border-color:#ddd !important">
                <p class="fw-semibold mb-3" style="font-size:0.85rem; color:var(--sp-teal)">Pilih Peran</p>
                <div class="row g-3">
                    <div class="col-6">
                        <div class="peran-card text-center p-3 rounded-3 border"
                             id="card-mitra" onclick="pilihPeran('restoran')">
                            <i class="bi bi-shop fs-2 d-block mb-1" style="color:var(--sp-teal)"></i>
                            <span class="fw-semibold" style="font-size:0.85rem">Mitra Kuliner</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="peran-card text-center p-3 rounded-3 border"
                             id="card-pengelola" onclick="pilihPeran('pengelola_pangan')">
                            <i class="bi bi-recycle fs-2 d-block mb-1" style="color:var(--sp-teal)"></i>
                            <span class="fw-semibold" style="font-size:0.85rem">Pengelola Pangan</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button class="btn btn-sp-green rounded-pill px-4 py-1 fw-semibold"
                        style="font-size:0.9rem" onclick="keStep2()">
                    Lanjut →
                </button>
            </div>

            <p class="text-center mt-3" style="font-size:0.85rem">
                Sudah punya akun?
                <a href="{{ route('login') }}" style="color:var(--sp-teal); text-decoration:none; fw-semibold">Masuk di sini</a>
            </p>
        </div>


        {{-- ================================================
             TAHAP 2 — Data Akun
        ================================================ --}}
        <div id="step-2" class="d-none">
            <h5 class="fw-semibold text-muted mb-3" id="title-step2" style="font-size:1rem"></h5>

            {{-- Step indicator --}}
            <div class="d-flex justify-content-center align-items-center gap-2 mb-4">
                <div class="step-dot done">1</div>
                <span class="text-muted">→</span>
                <div class="step-dot active">2</div>
                <span class="text-muted">→</span>
                <div class="step-dot">3</div>
            </div>

            <div class="border rounded-3 p-3 mb-3" style="border-color:#ddd !important">
                <p class="fw-semibold mb-3" style="font-size:0.85rem; color:var(--sp-teal)">Data Akun</p>

                <div class="mb-2">
                    <label class="form-label fw-semibold mb-1" style="font-size:0.85rem">Nama</label>
                    <input type="text" id="r_nama" class="form-control form-control-sm rounded-3"
                           placeholder="Nama lengkap">
                    <div class="invalid-msg d-none text-danger" style="font-size:0.75rem">Nama wajib diisi</div>
                </div>

                <div class="row g-2 mb-2">
                    <div class="col-7">
                        <label class="form-label fw-semibold mb-1" style="font-size:0.85rem">Email</label>
                        <input type="email" id="r_email" class="form-control form-control-sm rounded-3"
                               placeholder="contoh@email.com">
                        <div class="invalid-msg d-none text-danger" style="font-size:0.75rem">Email wajib diisi</div>
                    </div>
                    <div class="col-5">
                        <label class="form-label fw-semibold mb-1" style="font-size:0.85rem">Telepon</label>
                        <input type="text" id="r_telepon" class="form-control form-control-sm rounded-3"
                               placeholder="08xxxxxxxx">
                        <div class="invalid-msg d-none text-danger" style="font-size:0.75rem">Wajib diisi</div>
                    </div>
                </div>

                <div class="row g-2">
                    <div class="col-6">
                        <label class="form-label fw-semibold mb-1" style="font-size:0.85rem">Password</label>
                        <input type="password" id="r_password" class="form-control form-control-sm rounded-3"
                               placeholder="Minimal 8 karakter">
                        <div class="invalid-msg d-none text-danger" style="font-size:0.75rem">Min. 8 karakter</div>
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-semibold mb-1" style="font-size:0.85rem">Konfirmasi Password</label>
                        <input type="password" id="r_password_confirm" class="form-control form-control-sm rounded-3"
                               placeholder="Ulangi Password">
                        <div class="invalid-msg d-none text-danger" style="font-size:0.75rem">Password tidak cocok</div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button class="btn btn-outline-secondary rounded-pill px-4 py-1 fw-semibold"
                        style="font-size:0.9rem" onclick="keStep(1)">Kembali</button>
                <button class="btn btn-sp-green rounded-pill px-4 py-1 fw-semibold"
                        style="font-size:0.9rem" onclick="keStep3()">Lanjut →</button>
            </div>
        </div>


        {{-- ================================================
             TAHAP 3 — Profil Usaha
        ================================================ --}}
        <div id="step-3" class="d-none">
            <h5 class="fw-semibold text-muted mb-3" id="title-step3" style="font-size:1rem"></h5>

            {{-- Step indicator --}}
            <div class="d-flex justify-content-center align-items-center gap-2 mb-4">
                <div class="step-dot done">1</div>
                <span class="text-muted">→</span>
                <div class="step-dot done">2</div>
                <span class="text-muted">→</span>
                <div class="step-dot active">3</div>
            </div>

            <form id="form-register" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- Hidden fields dari step sebelumnya --}}
                <input type="hidden" name="role" id="h_role">
                <input type="hidden" name="nama" id="h_nama">
                <input type="hidden" name="email" id="h_email">
                <input type="hidden" name="telepon" id="h_telepon">
                <input type="hidden" name="password" id="h_password">
                <input type="hidden" name="password_confirmation" id="h_password_confirm">

                <div class="border rounded-3 p-3 mb-3" style="border-color:#ddd !important">
                    <p class="fw-semibold mb-3" style="font-size:0.85rem; color:var(--sp-teal)">Profil Usaha</p>

                    <div class="mb-2">
                        <label class="form-label fw-semibold mb-1" style="font-size:0.85rem">Nama Usaha</label>
                        <input type="text" name="nama_usaha" id="r_nama_usaha"
                               class="form-control form-control-sm rounded-3"
                               placeholder="">
                        <div class="invalid-msg d-none text-danger" style="font-size:0.75rem">Nama usaha wajib diisi</div>
                    </div>

                    {{-- Dropdown Mitra --}}
                    <div class="mb-2" id="field-jenis-usaha">
                        <label class="form-label fw-semibold mb-1" style="font-size:0.85rem">Jenis Usaha</label>
                        <select name="jenis_usaha" class="form-select form-select-sm rounded-3">
                            <option value="">Pilih jenis usaha</option>
                            <option value="restoran">Restoran</option>
                            <option value="katering">Katering</option>
                            <option value="hotel">Hotel</option>
                            <option value="kafe">Kafe</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                        <div class="invalid-msg d-none text-danger" style="font-size:0.75rem">Wajib dipilih</div>
                    </div>

                    {{-- Dropdown Pengelola --}}
                    <div class="mb-2 d-none" id="field-jenis-pengelolaan">
                        <label class="form-label fw-semibold mb-1" style="font-size:0.85rem">Jenis Pengelolaan</label>
                        <select name="jenis_pengelolaan" class="form-select form-select-sm rounded-3">
                            <option value="">Pilih jenis pengelolaan</option>
                            <option value="pakan_ternak">Pakan Ternak</option>
                            <option value="kompos">Kompos</option>
                            <option value="biogas">Biogas</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                        <div class="invalid-msg d-none text-danger" style="font-size:0.75rem">Wajib dipilih</div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label fw-semibold mb-1" style="font-size:0.85rem">Alamat</label>
                        <textarea name="alamat" id="r_alamat" rows="2"
                                  class="form-control form-control-sm rounded-3"
                                  placeholder="Alamat lengkap usaha" style="resize:none"></textarea>
                        <div class="invalid-msg d-none text-danger" style="font-size:0.75rem">Alamat wajib diisi</div>
                    </div>

                    {{-- DOKUMEN IZIN (Bisa Dihilangkan dengan JS) --}}
                    <div class="mb-1" id="field-dokumen">
                        <label class="form-label fw-semibold mb-1" style="font-size:0.85rem">Dokumen Izin</label>
                        <div class="border rounded-3 text-center py-3 px-2"
                             style="border-style:dashed !important; cursor:pointer"
                             onclick="document.getElementById('r_dokumen').click()">
                            <i class="bi bi-upload fs-4 d-block mb-1 text-muted"></i>
                            <div id="label-dokumen" class="text-muted" style="font-size:0.78rem">
                                Upload dokumen izin usaha<br>
                                <span style="font-size:0.72rem">PDF atau JPG, maks. 5MB</span>
                            </div>
                        </div>
                        <input type="file" name="dokumen_izin" id="r_dokumen"
                               class="d-none" accept=".pdf,.jpg,.jpeg,.png"
                               onchange="tampilNamaFile(this)">
                        <div class="invalid-msg d-none text-danger" style="font-size:0.75rem">Dokumen wajib diupload</div>
                    </div>

                </div>

                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4 py-1 fw-semibold"
                            style="font-size:0.9rem" onclick="keStep(2)">Kembali</button>
                    <button type="button" class="btn btn-sp-green rounded-pill px-4 py-1 fw-semibold"
                            style="font-size:0.9rem" id="btn-submit" onclick="submitForm()">
                        Daftar sekarang
                    </button>
                </div>

            </form>
        </div>


        {{-- ================================================
             HALAMAN VERIFIKASI — Semua peran
        ================================================ --}}
        <div id="step-verif" class="d-none text-center py-4">
            <div class="rounded-3 p-4" style="background:#e8e8e8; font-size:0.9rem; line-height:1.8; color:#555">
                <i class="bi bi-shield-check text-muted d-block mb-2" style="font-size:3rem"></i>
                Akun akan aktif setelah admin memverifikasi dokumen, biasanya
                dalam 1x24 jam. Notifikasi dikirim ke email kamu.
            </div>
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
let peranDipilih = null;

// Pilih peran
function pilihPeran(peran) {
    peranDipilih = peran;
    document.getElementById('card-mitra').classList.toggle('peran-active', peran === 'restoran');
    document.getElementById('card-pengelola').classList.toggle('peran-active', peran === 'pengelola_pangan');
}

// Navigasi antar step
function keStep(n) {
    ['step-1','step-2','step-3','step-verif'].forEach(id => {
        document.getElementById(id).classList.add('d-none');
    });
    document.getElementById('step-' + n).classList.remove('d-none');
}

// Step 1 → 2
function keStep2() {
    if (!peranDipilih) {
        alert('Pilih peran terlebih dahulu!');
        return;
    }
    const label = peranDipilih === 'restoran' ? 'Mitra Kuliner' : 'Pengelola Pangan';
    document.getElementById('title-step2').textContent = label + ' - Tahap 2';
    keStep(2);
}

// Step 2 → 3 dengan validasi
function keStep3() {
    const nama    = document.getElementById('r_nama');
    const email   = document.getElementById('r_email');
    const telepon = document.getElementById('r_telepon');
    const pass    = document.getElementById('r_password');
    const passC   = document.getElementById('r_password_confirm');

    let valid = true;

    // Reset
    [nama, email, telepon, pass, passC].forEach(el => {
        el.classList.remove('is-invalid');
        el.nextElementSibling.classList.add('d-none');
    });

    if (!nama.value.trim())             { invalid(nama); valid = false; }
    if (!email.value.trim())            { invalid(email); valid = false; }
    if (!telepon.value.trim())          { invalid(telepon); valid = false; }
    if (pass.value.length < 8)         { invalid(pass); valid = false; }
    if (pass.value !== passC.value)    { invalid(passC); valid = false; }

    if (!valid) return;

    // Set title step 3
    const label = peranDipilih === 'restoran' ? 'Mitra Kuliner' : 'Pengelola Pangan';
    document.getElementById('title-step3').textContent = label + ' - Tahap 3';

    // Tampilkan field sesuai peran
    document.getElementById('field-jenis-usaha').classList.toggle('d-none', peranDipilih !== 'restoran');
    document.getElementById('field-jenis-pengelolaan').classList.toggle('d-none', peranDipilih !== 'pengelola_pangan');
    
    // Sembunyikan field dokumen izin jika yang dipilih BUKAN restoran
    document.getElementById('field-dokumen').classList.toggle('d-none', peranDipilih !== 'restoran');

    // Placeholder nama usaha
    document.getElementById('r_nama_usaha').placeholder =
        peranDipilih === 'restoran' ? 'Nama restoran/katering/hotel' : 'Nama peternakan/usaha kompos';

    // Tombol submit
    document.getElementById('btn-submit').textContent = 'Daftar sekarang';

    keStep(3);
}

// Submit form
function submitForm() {
    const namaUsaha = document.getElementById('r_nama_usaha');
    const alamat    = document.getElementById('r_alamat');
    const dokumen   = document.getElementById('r_dokumen');

    let valid = true;

    [namaUsaha, alamat].forEach(el => {
        el.classList.remove('is-invalid');
        el.nextElementSibling.classList.add('d-none');
    });

    if (!namaUsaha.value.trim()) { invalid(namaUsaha); valid = false; }
    if (!alamat.value.trim())    { invalid(alamat); valid = false; }
    
    // Cek dokumen hanya kalau perannya adalah restoran
    if (peranDipilih === 'restoran') {
        if (!dokumen.files.length)   {
            dokumen.nextElementSibling.classList.remove('d-none');
            valid = false;
        }
    }

    if (!valid) return;

    // Isi hidden fields
    document.getElementById('h_role').value             = peranDipilih;
    document.getElementById('h_nama').value             = document.getElementById('r_nama').value;
    document.getElementById('h_email').value            = document.getElementById('r_email').value;
    document.getElementById('h_telepon').value          = document.getElementById('r_telepon').value;
    document.getElementById('h_password').value         = document.getElementById('r_password').value;
    document.getElementById('h_password_confirm').value = document.getElementById('r_password_confirm').value;

    // Kedua peran: tampilkan halaman verifikasi setelah submit
    // Data dikirim ke admin untuk direview, belum masuk DB utama
    document.getElementById('form-register').submit();
}

// Helper invalid
function invalid(el) {
    el.classList.add('is-invalid');
    el.nextElementSibling.classList.remove('d-none');
}

// Tampil nama file setelah upload
function tampilNamaFile(input) {
    if (input.files.length) {
        document.getElementById('label-dokumen').innerHTML =
            '<i class="bi bi-file-earmark-check text-success"></i> ' + input.files[0].name;
    }
}

// Cek session verifikasi dari server
@if(session('verifikasi'))
document.addEventListener('DOMContentLoaded', function() {
    ['step-1','step-2','step-3'].forEach(id => {
        document.getElementById(id).classList.add('d-none');
    });
    document.getElementById('step-verif').classList.remove('d-none');
});
@endif
</script>
@endpush