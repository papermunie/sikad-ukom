<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriPemasukan;

class KategoriPemasukanController extends Controller
{
    public function index()
    {
        $kategoriPemasukan = KategoriPemasukan::all();
        return view('kategori_pemasukan.index', compact('kategoriPemasukan'));
    }

    public function create()
    {
        return view('kategori_pemasukan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_pemasukan' => 'required|string|max:255',
        ]);

        KategoriPemasukan::create($request->all());

        return redirect()->route('kategori_pemasukan.index')->with('success', 'Kategori Pemasukan berhasil ditambahkan.');
    }
}
?>