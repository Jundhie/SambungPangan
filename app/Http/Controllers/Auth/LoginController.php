<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /**
     * Helper untuk menentukan route dashboard berdasarkan role sesuai ENUM DB.
     */
    private function getDashboardRoute($user)
    {
        if ($user->role === 'administrator') {
            return route('admin.dashboard');
        } elseif ($user->role === 'restoran') { // Sesuai Enum DB
            return route('mitra.dashboard');
        } elseif ($user->role === 'pengelola_pangan') { // Sesuai Enum DB
            return route('pengelola.dashboard');
        }

        return route('dashboard'); // Fallback umum
    }

    /**
     * Tampilkan form login
     */
    public function showLoginForm()
    {
        // Jika sudah login, langsung lempar ke dashboard masing-masing
        if (Auth::check()) {
            return redirect($this->getDashboardRoute(Auth::user()));
        }

        return view('publik.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Cek status verifikasi
            if ($user->role === 'restoran') {
                $mitra = $user->mitraKuliner;
                if ($mitra && $mitra->status_verifikasi === 'pending') {
                    Auth::logout();
                    return back()->with('error', 'Akun Anda masih menunggu verifikasi admin.');
                }
            } elseif ($user->role === 'pengelola_pangan') {
                $pengelola = $user->pengelolaPangan;
                if ($pengelola && $pengelola->status_verifikasi === 'pending') {
                    Auth::logout();
                    return back()->with('error', 'Akun Anda masih menunggu verifikasi admin.');
                }
            }

            // Insert log login
            \DB::table('log_aktivitas')->insert([
                'id_user'    => $user->id_user,
                'waktu'      => now(),
                'aksi'       => 'Login',
                'keterangan' => $user->name . ' (' . $user->role . ') berhasil login.',
            ]);

            return redirect()->intended($this->getDashboardRoute($user));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        // Insert log logout
        \DB::table('log_aktivitas')->insert([
            'id_user'    => $user->id_user,
            'waktu'      => now(),
            'aksi'       => 'Logout',
            'keterangan' => $user->name . ' (' . $user->role . ') logout.',
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}