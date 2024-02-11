<?php

namespace App\Http\Controllers;

use App\Models\PemasukanKas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class PemasukanKasController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $pemasukan = PemasukanKas::when($search, function ($query) use ($search) {
                $query->where('kode_pemasukan', 'like', '%' . $search . '%')
                    ->orWhere('jenis_pemasukan', 'like', '%' . $search . '%')
                    ->orWhere('tanggal_pemasukan', 'like', '%' . $search . '%')
                    ->orWhere('jumlah_pemasukan', 'like', '%' . $search . '%');
            })
            ->get();
    
        return view('pemasukan.index', compact('pemasukan'));
    }
    

    public function create()
    {
        return view('pemasukan.create');
    }
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'kode_pemasukan' => 'required|unique:pemasukan_kas',
            'jenis_pemasukan' => 'required|in:Amal Harian,Sumbangan,Infaq',
            'tanggal_pemasukan' => 'required|date',
            'jumlah_pemasukan' => 'required',
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
        PemasukanKas::create($validatedData);


        return redirect()->route('pemasukan.index')->with('success', 'pemasukan berhasil ditambahkan');
    }
    public function edit($id)
    {
        $pemasukan = PemasukanKas::findOrFail($id);
        return view('pemasukan.edit', ['pemasukan' => $pemasukan]);
    }


public function update(Request $request, $id)
    {

        $kode_pemasukan = $request->input('kode_pemasukan');

        $validatedData = $request->validate([
            'jenis_pemasukan' => 'required|in:Amal Harian,Sumbangan,Infaq',
            'tanggal_pemasukan' => 'required|date',
            'jumlah_pemasukan' => 'required',
            'dokumentasi' => 'file',
        ]);

        $pemasukan = PemasukanKas::findOrFail($id);

        if ($request->hasFile('dokumentasi')) {
            $foto_file = $request->file('dokumentasi');

            // mengambil file foto extension nya
            $foto_extension = $foto_file->getClientOriginalExtension(); 

            // mengambil file file foto name ya, dan memberikan hashing nya
            $foto_nama = md5($foto_file->getClientOriginalName() . time()) . '.' . $foto_extension;
            $foto_file->move(public_path('dokumentasi'), $foto_nama);

            // mencari file lama, dengan mengambil dari primary key nya
            $update_data = PemasukanKas::where('kode_pemasukan', $kode_pemasukan)->first();

            // menghapus file foto yang lama
            File::delete(public_path('dokumentasi') . '/' . $update_data->file);

            $validatedData['dokumentasi'] = $foto_nama;
        }

        // Update pemasukan
        $pemasukan->update($validatedData);

        return redirect()->route('pemasukan.index')->with('success', 'pemasukan berhasil diperbarui');
    }

    public function show($id)
{
    $pemasukan = PemasukanKas::findOrFail($id);
    return view('pemasukan.show', ['pemasukan' => $pemasukan]);
}

public function destroy($id)
    {
        $pemasukan = PemasukanKas::findOrFail($id);
        $pemasukan->delete();
        return redirect()->route('pemasukan.index')->with('success', 'Pemasukan berhasil dihapus');
    }
    
}