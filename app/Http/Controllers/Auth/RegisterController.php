<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MitraKuliner;
use App\Models\PengelolaPangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Tampilkan form register
     */
    public function showRegistrationForm()
    {
        return view('publik.register');
    }

    /**
     * Proses registrasi
     */
    public function register(Request $request)
    {
        // Validasi
        $request->validate([
            'nama'              => 'required|string|max:255',
            'email'             => 'required|email|unique:users,email',
            'telepon'           => 'required|string|max:20',
            'password'          => 'required|string|min:8|confirmed',
            'role'              => 'required|in:restoran,pengelola_pangan',
            'nama_usaha'        => 'required|string|max:255',
            'alamat'            => 'required|string',
            // Dokumen hanya wajib jika role-nya restoran
            'dokumen_izin'      => 'required_if:role,restoran|file|mimes:pdf,jpg,jpeg,png|max:5120',
            // PERBAIKAN: role aslinya adalah restoran, bukan mitra
            'jenis_usaha'       => 'required_if:role,restoran', 
            'jenis_pengelolaan' => 'required_if:role,pengelola_pangan',
        ]);

        // Simpan dokumen (Hanya jika role adalah restoran dan ada file yang diupload)
        $pathDokumen = null;
        if ($request->hasFile('dokumen_izin') && $request->role === 'restoran') {
            $pathDokumen = $request->file('dokumen_izin')->store('dokumen_izin', 'public');
        }

        // Simpan user
        $user = User::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'telepon'  => $request->telepon,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        // Simpan ke tabel sesuai peran dengan status pending
        if ($request->role === 'restoran') {
            MitraKuliner::create([
                'id_user'           => $user->id_user,
                'nama_usaha'        => $request->nama_usaha,
                'jenis_usaha'       => $request->jenis_usaha,
                'alamat'            => $request->alamat,
                'dokumen_izin'      => $pathDokumen, // Dokumen tetap disimpan untuk restoran
                'status_verifikasi' => 'pending',
            ]);
        } else {
            // Untuk Pengelola Pangan
            PengelolaPangan::create([
                'id_user'           => $user->id_user,
                'nama_usaha'        => $request->nama_usaha,
                'jenis_pengelolaan' => $request->jenis_pengelolaan,
                'alamat'            => $request->alamat,
                // Baris 'dokumen_izin' SUDAH DIHAPUS karena di LRS nggak ada
                'status_verifikasi' => 'pending',
            ]);
        }

        // Redirect ke halaman sebelumnya sambil membawa session bahwa berhasil dikirim
        return redirect()->back()->with('verifikasi', true);
    }
}