<?php

namespace App\Http\Controllers\publik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function beranda()
    {
        return view('publik.beranda');
    }

    public function tentang()
    {
        return view('publik.tentang');
    }

    public function kontak()
    {
        return view('publik.kontak');
    }
}