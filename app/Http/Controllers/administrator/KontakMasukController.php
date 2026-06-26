<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KontakPesan; // Pastikan model lu udah dibuat ya

class KontakMasukController extends Controller
{
    public function index()
    {
        $pesans = KontakPesan::orderBy('id_pesan', 'desc')->paginate(10);
        
        // Menggunakan dot notation untuk masuk ke folder admin
        return view('admin.kontak_masuk', compact('pesans'));
    }
}