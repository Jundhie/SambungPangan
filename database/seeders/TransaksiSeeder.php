<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MitraKuliner;
use App\Models\PengelolaPangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nama'              => 'required|string|max:255',
            'email'             => 'required|email|unique:users,email',
            'telepon'           => 'required|string|max:20',
            'password'          => 'required|string|min:8|confirmed',
            'role'              => 'required|in:restoran,pengelola_pangan',
            'nama_usaha'        => 'required|string|max:255',
            'alamat'            => 'required|string',
            'dokumen_izin'      => 'required_if:role,restoran|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'jenis_usaha'       => 'required_if:role,restoran', 
            'jenis_pengelolaan' => 'required_if:role,pengelola_pangan',
        ]);

        DB::transaction(function () use ($request) {
            $pathDokumen = null;
            if ($request->hasFile('dokumen_izin')) {
                $pathDokumen = $request->file('dokumen_izin')->store('dokumen_izin', 'public');
            }

            $user = User::create([
                'nama'     => $request->nama,
                'email'    => $request->email,
                'telepon'  => $request->telepon,
                'password' => Hash::make($request->password),
                'role'     => $request->role,
            ]);

            if ($request->role === 'restoran') {
                MitraKuliner::create([
                    'id_user' => $user->id_user,
                    'nama_usaha' => $request->nama_usaha,
                    'jenis_usaha' => $request->jenis_usaha,
                    'alamat' => $request->alamat,
                    'dokumen_izin' => $pathDokumen,
                    'status_verifikasi' => 'pending',
                ]);
            } else {
                PengelolaPangan::create([
                    'id_user' => $user->id_user,
                    'nama_usaha' => $request->nama_usaha,
                    'jenis_pengelolaan' => $request->jenis_pengelolaan,
                    'alamat' => $request->alamat,
                    'status_verifikasi' => 'pending',
                ]);
            }
        });

        return redirect()->back()->with('verifikasi', true);
    }
}