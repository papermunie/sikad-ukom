<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use Illuminate\Http\Request;
use App\Models\PemasukanKas;
use App\Models\PengeluaranKas;

class PengunjungController extends Controller
{
    public function index(Request $request)
    {    $search = $request->input('search');
        
        $pemasukan = PemasukanKas::when($search, function ($query) use ($search) {
                $query->where('kode_pemasukan', 'like', '%' . $search . '%')
                    ->orWhere('jenis_pemasukan', 'like', '%' . $search . '%')
                    ->orWhere('tanggal_pemasukan', 'like', '%' . $search . '%')
                    ->orWhere('jumlah_pemasukan', 'like', '%' . $search . '%');
            })
            ->get();
        return view('pengunjung.pengunjungg');
    }

    public function laporan(){
        return view('pengunjung.pengunjungg');
    }

    public function laporanmasuk(){
        $pemasukanKas = PemasukanKas::all();
        return view('pengunjung.laporanmasuk', compact('pemasukanKas'));
    }

    public function laporankeluar(){
        $pengeluaranKas = PengeluaranKas::all();
        return view('pengunjung.laporankeluar', compact('pengeluaranKas'));
    }
    
}