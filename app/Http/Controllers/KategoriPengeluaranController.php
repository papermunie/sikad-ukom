<?php

namespace App\Http\Controllers;

use App\Models\KategoriPengeluaran;
use Illuminate\Http\Request;

class KategoriPengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategoriPengeluaran = KategoriPengeluaran::all();
        return view('kategori_pengeluaran.index', compact('kategoriPengeluaran'));
    }
    public function jenispengeluaran()
    {
        $kategoriPengeluaran = KategoriPengeluaran::latest()->paginate(5);
        return view('kategori_pengeluaran.jenis_pengeluaran', compact('kategoriPengeluaran'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori_pengeluaran.create');
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
            'id_kategori_pengeluaran' => 'required|string|max:5|unique:kategori_pengeluaran',
            'jenis_pengeluaran' => 'required|string|max:40',
        ]);

        KategoriPengeluaran::create($request->all());

        return redirect()->route('kategori_pengeluaran.jenis_pengeluaran')
            ->with('success', 'Kategori pengeluaran berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategoriPengeluaran = KategoriPengeluaran::findOrFail($id);
        return view('kategori_pengeluaran.edit', compact('kategoriPengeluaran'));
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
            'jenis_pengeluaran' => 'required|string|max:40',
        ]);

        $kategoriPengeluaran = KategoriPengeluaran::findOrFail($id);
        $kategoriPengeluaran->update($request->all());

        return redirect()->route('kategori_pengeluaran.jenis_pengeluaran')
            ->with('success', 'Kategori pengeluaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategoriPengeluaran = KategoriPengeluaran::findOrFail($id);
        $kategoriPengeluaran->delete();

        return redirect()->route('kategori_pengeluaran.jenis_pengeluaran')
            ->with('success', 'Kategori pengeluaran berhasil dihapus.');
    }
}
