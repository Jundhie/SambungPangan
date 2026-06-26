<?php

namespace App\Http\Controllers\publik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\KontakPesan; // 👈 Panggil Modelnya di sini

class KontakController extends Controller
{
    public function kirim(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:100',
            'email' => 'required|email',
            'pesan' => 'required|string|min:10',
        ], [
            'nama.required'  => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'pesan.required' => 'Pesan wajib diisi.',
            'pesan.min'      => 'Pesan minimal 10 karakter.',
        ]);

        // Simpan data langsung ke database
        KontakPesan::create([
            'nama_lengkap' => $request->nama, // 👈 Pastikan 'nama_lengkap' sesuai dengan nama kolom di database lu
            'email'        => $request->email,
            'pesan'        => $request->pesan,
        ]);

        // Jika pakai Mail, uncomment ini:
        // Mail::to('media@sambungpangan.id')->send(new \App\Mail\PesanKontak($request->all()));

        // \Log::info dihapus aja karena udah masuk DB

        return redirect()->route('kontak')
            ->with('success', 'Pesan Anda berhasil terkirim! Kami akan menghubungi Anda segera.');
    }
}