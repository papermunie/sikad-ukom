<?php

namespace App\Http\Controllers;

use App\Models\PengeluaranKas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class PengeluaranKasController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $pengeluaran = PengeluaranKas::when($search, function ($query) use ($search) {
                $query->where('kode_pengeluaran', 'like', '%' . $search . '%')
                    ->orWhere('jenis_pengeluaran', 'like', '%' . $search . '%')
                    ->orWhere('tanggal_pengeluaran', 'like', '%' . $search . '%')
                    ->orWhere('jumlah_pengeluaran', 'like', '%' . $search . '%');
            })
            ->get();
    
        return view('pengeluaran.index', compact('pengeluaran'));
    }
    

    public function create()
    {
        return view('pengeluaran.create');
    }
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'kode_pengeluaran' => 'required|unique:pengeluaran_kas',
            'jenis_pengeluaran' => 'required',
            'tanggal_pengeluaran' => 'required|date',
            'jumlah_pengeluaran' => 'required',
            'dokumentasi' => 'file',
        ]);

        if ($request->hasFile('dokumentasi') && $request->file('dokumentasi')->isValid()) {
            $foto_file = $request->file('dokumentasi');

            // membuat nama file foto nya, dan mengambil extension file foto gambar nya
            // dan berikan hashing pada file foto nama nya
            $foto_nama = md5($foto_file->getClientOriginalName() . time()) . '.' . $foto_file->getClientOriginalExtension();

            // kemudian dipindahkan file foto nya dokumentasi ke public path pada direktori dokumentasi
            $foto_file->move(public_path('dokumentasi'), $foto_nama);
            $validatedData['dokumentasi'] = $foto_nama;
        }

        // kemudian simpan ke dalam database
        PengeluaranKas::create($validatedData);


        return redirect()->route('pengeluaran.index')->with('success', 'pengeluaran berhasil ditambahkan');
    }
    public function edit($id)
    {
        $pengeluaran = PengeluaranKas::findOrFail($id);
        return view('pengeluaran.edit', ['pengeluaran' => $pengeluaran]);
    }


public function update(Request $request, $id)
    {

        $kode_pengeluaran = $request->input('kode_pengeluaran');

        $validatedData = $request->validate([
            'jenis_pengeluaran' => 'required',
            'tanggal_pengeluaran' => 'required|date',
            'jumlah_pengeluaran' => 'required',
            'dokumentasi' => 'file',
        ]);

        $pengeluaran = PengeluaranKas::findOrFail($id);

        if ($request->hasFile('dokumentasi')) {
            $foto_file = $request->file('dokumentasi');

            // mengambil file foto extension nya
            $foto_extension = $foto_file->getClientOriginalExtension(); 

            // mengambil file file foto name ya, dan memberikan hashing nya
            $foto_nama = md5($foto_file->getClientOriginalName() . time()) . '.' . $foto_extension;
            $foto_file->move(public_path('dokumentasi'), $foto_nama);

            // mencari file lama, dengan mengambil dari primary key nya
            $update_data = PengeluaranKas::where('kode_pengeluaran', $kode_pengeluaran)->first();

            // menghapus file foto yang lama
            File::delete(public_path('dokumentasi') . '/' . $update_data->file);

            $validatedData['dokumentasi'] = $foto_nama;
        }

        // Update pengeluaran
        $pengeluaran->update($validatedData);

        return redirect()->route('pengeluaran.index')->with('success', 'pengeluaran berhasil diperbarui');
    }

    public function show($id)
{
    $pengeluaran = PengeluaranKas::findOrFail($id);
    return view('pengeluaran.show', ['pengeluaran' => $pengeluaran]);
}

public function destroy($id)
    {
        $pengeluaran = PengeluaranKas::findOrFail($id);
        $pengeluaran->delete();
        return redirect()->route('pengeluaran.index')->with('success', 'pengeluaran berhasil dihapus');
    }
    
}