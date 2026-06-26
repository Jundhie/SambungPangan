<?php

namespace App\Http\Controllers\Administrator; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ListingLimbah;

class ListingLimbahController extends Controller
{
    public function index(Request $request)
    {
        // Menggunakan latest() untuk otomatis mengurutkan berdasarkan created_at dari yang terbaru
        $query = ListingLimbah::with(['mitraKuliner', 'kategoriLimbah'])->latest();

        // Fitur pencarian berdasarkan nama mitra atau deskripsi listing
        if ($request->has('cari') && $request->cari != '') {
            $query->whereHas('mitraKuliner', function($q) use ($request) {
                $q->where('nama_usaha', 'like', '%' . $request->cari . '%');
            })->orWhere('deskripsi', 'like', '%' . $request->cari . '%');
        }

        // Ambil 8 data per halaman
        $listings = $query->paginate(8);

        // Pertahankan query string pencarian saat pindah halaman pagination
        $listings->appends($request->all());

        return view('admin.listing_limbah', compact('listings'));
    }
}