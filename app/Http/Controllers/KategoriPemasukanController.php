<?php

namespace App\Http\Controllers;

use App\Models\KategoriPemasukan;
use Illuminate\Http\Request;

class KategoriPemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $kategoriPemasukan = KategoriPemasukan::all();
        return view('kategori_pemasukan.index', compact('kategoriPemasukan'));
    }
    public function jenispemasukan()
    {
        $kategoriPemasukan = KategoriPemasukan::latest()->paginate(5);
        return view('kategori_pemasukan.jenis_pemasukan', compact('kategoriPemasukan'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori_pemasukan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_kategori_pemasukan' => 'required|string|max:5|unique:kategori_pemasukan',
            'jenis_pemasukan' => 'required|string|max:40',
        ]);

        KategoriPemasukan::create($request->all());

        return redirect()->route('kategori_pemasukan.jenis_pemasukan')
            ->with('success', 'Kategori Pemasukan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $kategoriPemasukan = KategoriPemasukan::findOrFail($id);
        return view('kategori_pemasukan.edit', compact('kategoriPemasukan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_pemasukan' => 'required|string|max:40',
        ]);

       $kategoriPemasukan = KategoriPemasukan::findOrFail($id);
       $kategoriPemasukan->update($request->all());

        return redirect()->route('kategori_pemasukan.jenis_pemasukan')
            ->with('success', 'Kategori Pemasukan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $kategoriPemasukan = KategoriPemasukan::findOrFail($id);
       $kategoriPemasukan->delete();

        return redirect()->route('kategori_pemasukan.jenis_pemasukan')
            ->with('success', 'Kategori Pemasukan berhasil dihapus.');
    }
    
}
