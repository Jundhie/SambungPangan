<?php

namespace App\Http\Controllers\publik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        // Jika pakai Mail, uncomment ini:
        // Mail::to('media@sambungpangan.id')->send(new \App\Mail\PesanKontak($request->all()));

        // Untuk sementara simpan ke log atau session saja
        \Log::info('Pesan kontak baru', $request->only(['nama', 'email', 'pesan']));

        return redirect()->route('kontak')
            ->with('success', 'Pesan Anda berhasil terkirim! Kami akan menghubungi Anda segera.');
    }
}