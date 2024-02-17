<?php

namespace App\Http\Controllers;

use App\Models\PemasukanKas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
class PemasukanKasController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        
        $pemasukan = PemasukanKas::query()
        ->when($search, function ($query) use ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('jenis_pemasukan', 'like', '%' . $search . '%')
                    ->orWhere('jumlah_pemasukan', 'like', '%' . $search . '%')
                    ->orWhereDate('tanggal_pemasukan', 'like', '%' . $search . '%')
                    ->orWhere('kode_pemasukan', 'like', '%' . $search . '%');
            });
        })
        ->paginate(5);
    
    
    
        return view('pemasukan.index', compact('pemasukan'));
    }
    

    public function create()
    {
        return view('pemasukan.create');
    }
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            // 'kode_pemasukan' => 'required|unique:pemasukan_kas',
            'jenis_pemasukan' => 'required|in:Amal Harian,Sumbangan,Infaq',
            'tanggal_pemasukan' => 'required|date',
            'jumlah_pemasukan' => 'required',
            'dokumentasi' => 'file',
        ]);

        $kode = DB::select('SELECT generate_pemasukan() AS kode_pemasukan')[0]->kode_pemasukan;
        $validatedData['kode_pemasukan'] = $kode;

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
        $validatedData = $request->validate([
            'kode_pemasukan' => 'required',
            'jenis_pemasukan' => 'required|in:Amal Harian,Sumbangan,Infaq',
            'tanggal_pemasukan' => 'required|date',
            'jumlah_pemasukan' => 'required',
            'dokumentasi' => 'file',
        ]);
    
        $pemasukan = PemasukanKas::findOrFail($id);
    
        // Check if there is a file uploaded in the current request
        if ($request->hasFile('dokumentasi')) {
            $foto_file = $request->file('dokumentasi');
    
            // Process file upload
            $foto_extension = $foto_file->getClientOriginalExtension(); 
            $foto_nama = md5($foto_file->getClientOriginalName() . time()) . '.' . $foto_extension;
            $foto_file->move(public_path('dokumentasi'), $foto_nama);
    
            // If there was a file uploaded, update the 'dokumentasi' field
            $validatedData['dokumentasi'] = $foto_nama;
    
            // If there was an existing file, delete it
            if ($pemasukan->dokumentasi) {
                File::delete(public_path('dokumentasi') . '/' . $pemasukan->dokumentasi);
            }
        }
    
        // Update pemasukan
        $pemasukan->update($validatedData);
    
        return redirect()->route('pemasukan.index')->with('success', 'Pemasukan berhasil diperbarui');
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