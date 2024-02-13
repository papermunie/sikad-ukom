<?php

namespace App\Http\Controllers;

use App\Models\PemasukanKas;
use App\Models\PengeluaranKas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class BendaharaController extends Controller

{  
    
    public function bendaharalogin()
    {
        $data['title'] = 'Login';
        // return view('user/login', $data);

        if(!Auth::user()) {
            return view('bendahara.login', $data);
        }

        return redirect()->to('/bendahara');
    }

    public function bendaharalogin_action(Request $request)
    {
        $request->validate([
            'email_user' => 'required',
            'password' => 'required',
        ]);
    
        // Ganti 'App\Models\User' dengan namespace yang sesuai jika perlu
        $user = User::where('email_user', $request->email_user)->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Wrong email or password',
            ]);
        }
    //login error trus dibenerin disini
        Auth::login($user);
        $request->session()->regenerate();
    
        // Menggunakan intended untuk mengarahkan pengguna ke halaman yang dimaksud setelah login
        return redirect()->intended('/bendahara');
    }
    

    public function bendaharapassword()
    {
        $data['title'] = 'Change Password';
        return view('user/password', $data);
    }

    public function bendaharapassword_action(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        $user = User::find(Auth::id());

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors([
                'old_password' => 'Incorrect old password',
            ]);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();
        $request->session()->regenerate();

        return back()->with('success', 'Password changed!');
    }

    public function bendaharalogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function pemasukanindex(Request $request)
        {
            $search = $request->input('search');
            
            $pemasukan = PemasukanKas::when($search, function ($query) use ($search) {
                    $query->where('kode_pemasukan', 'like', '%' . $search . '%')
                        ->orWhere('jenis_pemasukan', 'like', '%' . $search . '%')
                        ->orWhere('tanggal_pemasukan', 'like', '%' . $search . '%')
                        ->orWhere('jumlah_pemasukan', 'like', '%' . $search . '%');
                })
                ->get();
        
            return view('bendahara.pemasukan.index', compact('pemasukan'));
        }
        
    
        public function pemasukancreate()
        {
            return view('bendahara.pemasukan.create');
        }
        public function pemasukanstore(Request $request)
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
    
    
            return redirect()->route('bendahara.pemasukan.index')->with('success', 'pemasukan berhasil ditambahkan');
        }
        public function pemasukanedit($id)
        {
            $pemasukan = PemasukanKas::findOrFail($id);
            return view('bendahara.pemasukan.edit', ['pemasukan' => $pemasukan]);
        }
    
    
    public function pemasukanupdate(Request $request, $id)
        {
    
            $validatedData = $request->validate([
                'kode_pemasukan' => 'required',
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
    
            return redirect()->route('bendahara.pemasukan.index')->with('success', 'pemasukan berhasil diperbarui');
        }
    
        public function pemasukanshow($id)
    {
        $pemasukan = PemasukanKas::findOrFail($id);
        return view('bendahara.pemasukan.show', ['pemasukan' => $pemasukan]);
    }
    
    public function pemasukandestroy($id)
        {
            $pemasukan = PemasukanKas::findOrFail($id);
            $pemasukan->delete();
            return redirect()->route('bendahara.pemasukan.index')->with('success', 'Pemasukan berhasil dihapus');
        }

    public function pengeluaranindex(Request $request)
    {
        $search = $request->input('search');
        
        $pengeluaran = PengeluaranKas::when($search, function ($query) use ($search) {
                $query->where('kode_pengeluaran', 'like', '%' . $search . '%')
                    ->orWhere('jenis_pengeluaran', 'like', '%' . $search . '%')
                    ->orWhere('tanggal_pengeluaran', 'like', '%' . $search . '%')
                    ->orWhere('jumlah_pengeluaran', 'like', '%' . $search . '%');
            })
            ->get();
    
        return view('bendahara.pengeluaran.index', compact('pengeluaran'));
    }
    

    public function pengeluarancreate()
    {
        return view('bendahara.pengeluaran.create');
    }

    public function pengeluaranstore(Request $request)
    {

        $validatedData = $request->validate([
            'kode_pengeluaran' => 'required|unique:pengeluaran_kas',
            'jenis_pengeluaran' => 'required',
            'tanggal_pengeluaran' => 'required|date',
            'jumlah_pengeluaran' => 'required',
        ]);

        // kemudian simpan ke dalam database
        PengeluaranKas::create($validatedData);


        return redirect()->route('bendahara.pengeluaran.index')->with('success', 'pengeluaran berhasil ditambahkan');
    }
    public function pengeluaranedit($id)
    {
        $pengeluaran = PengeluaranKas::findOrFail($id);
        return view('bendahara.pengeluaran.edit', ['pengeluaran' => $pengeluaran]);
    }


public function pengeluaranupdate(Request $request, $id)
    {

    
        $validatedData = $request->validate([
            'kode_pengeluaran' => 'required',
            'jenis_pengeluaran' => 'required',
            'tanggal_pengeluaran' => 'required|date',
            'jumlah_pengeluaran' => 'required',
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
        }

        // Update pengeluaran
        $pengeluaran->update($validatedData);

        return redirect()->route('bendahara.pengeluaran.index')->with('success', 'pengeluaran berhasil diperbarui');
    }

    public function pengeluaranshow($id)
{
    $pengeluaran = PengeluaranKas::findOrFail($id);
    return view('bendahara.pengeluaran.show', ['pengeluaran' => $pengeluaran]);
}

public function pengeluarandestroy($id)
    {
        $pengeluaran = PengeluaranKas::findOrFail($id);
        $pengeluaran->delete();
        return redirect()->route('bendahara.pengeluaran.index')->with('success', 'pengeluaran berhasil dihapus');
    }
    
}
        
