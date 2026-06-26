<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\KategoriLimbah;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = KategoriLimbah::orderBy('nama_kategori')->get();
        return view('admin.kategori', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.tambahkategori');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'keterangan'    => 'required|string',
            'peruntukan'    => 'required|string|max:255',
            'deskripsi'     => 'nullable|string',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'keterangan.required'    => 'Deskripsi wajib diisi.',
            'peruntukan.required'    => 'Pemanfaatan wajib diisi.',
        ]);

        KategoriLimbah::create([
            'nama_kategori' => $request->nama_kategori,
            'keterangan'    => $request->keterangan,
            'peruntukan'    => $request->peruntukan,
            'deskripsi'     => $request->deskripsi,
        ]);

        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategori = KategoriLimbah::findOrFail($id);
        return view('admin.editkategori', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'keterangan'    => 'required|string',
            'peruntukan'    => 'required|string|max:255',
            'deskripsi'     => 'nullable|string',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'keterangan.required'    => 'Deskripsi wajib diisi.',
            'peruntukan.required'    => 'Pemanfaatan wajib diisi.',
        ]);

        $kategori = KategoriLimbah::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'keterangan'    => $request->keterangan,
            'peruntukan'    => $request->peruntukan,
            'deskripsi'     => $request->deskripsi,
        ]);

        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori = KategoriLimbah::findOrFail($id);
        $kategori->delete();

        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil dihapus.');
    }
}