<?php

namespace App\Http\Controllers;

use App\Models\PemasukanKas;
use App\Models\PengeluaranKas;
use App\Models\User;
use App\Models\KategoriPemasukan;
use App\Models\KategoriPengeluaran;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
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

    // Temukan pengguna berdasarkan email
    $user = User::where('email_user', $request->email_user)->first();

    // Periksa apakah pengguna ada dan kata sandinya cocok
    if ($user && Hash::check($request->password, $user->password)) {
        // Login pengguna
        Auth::login($user);

        // Jika login berhasil, arahkan ke halaman yang dimaksud
        return redirect()->intended('/bendahara');
    } else {
        // Jika pengguna tidak ditemukan atau kata sandi salah, kembalikan pesan kesalahan
        return back()->withErrors([
            'email_user' => 'Wrong email or password',
        ]);
    }
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
    public function bendaharalogs()
    {
        $logs = ActivityLog::latest()->paginate(10);

        return view('bendahara.logs.index', compact('logs'));
    }
    public function pemasukanindex(Request $request)
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
    
    
        return view('bendahara.pemasukan.index', compact('pemasukan'));
    }
        
    
        public function pemasukancreate()
        {
            return view('bendahara.pemasukan.create');
        }
        public function pemasukanstore(Request $request)
        {
    
            $validatedData = $request->validate([
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
    
    
            return redirect()->route('bendahara.pemasukan.index')->with('success', 'Pemasukan berhasil ditambahkan');
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
        
        $pengeluaran = PengeluaranKas::query()
        ->when($search, function ($query) use ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('jenis_pengeluaran', 'like', '%' . $search . '%')
                    ->orWhere('jumlah_pengeluaran', 'like', '%' . $search . '%')
                    ->orWhereDate('tanggal_pengeluaran', 'like', '%' . $search . '%')
                    ->orWhere('kode_pengeluaran', 'like', '%' . $search . '%');
            });
        })
        ->paginate(5);
    
        return view('bendahara.pengeluaran.index', compact('pengeluaran'));
    }
    

    public function pengeluarancreate()
    {
        return view('bendahara.pengeluaran.create');
    }

    public function pengeluaranstore(Request $request)
    {

        $validatedData = $request->validate([
            'jenis_pengeluaran' => 'required',
            'tanggal_pengeluaran' => 'required|date',
            'jumlah_pengeluaran' => 'required',
        ]);

        $kode = DB::select('SELECT generate_pengeluaran() AS kode_pengeluaran')[0]->kode_pengeluaran;
        $validatedData['kode_pengeluaran'] = $kode;

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

    public function kategorimasukindex()
    {
       $kategoriPemasukan = KategoriPemasukan::all();
        return view('bendahara.kategori_pemasukan.index', compact('kategoriPemasukan'));
    }
    public function bendaharajenispemasukan()
    {
        $kategoriPemasukan = KategoriPemasukan::latest()->paginate(5);
        return view('bendahara.kategori_pemasukan.jenis_pemasukan', compact('kategoriPemasukan'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function kategorimasukcreate()
    {
        return view('bendahara.kategori_pemasukan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function kategorimasukstore(Request $request)
    {
        $request->validate([
            'id_kategori_pemasukan' => 'required|string|max:5|unique:kategori_pemasukan',
            'jenis_pemasukan' => 'required|string|max:40',
        ]);

        KategoriPemasukan::create($request->all());

        return redirect()->route('bendahara.kategori_pemasukan.jenis_pemasukan')
            ->with('success', 'Kategori Pemasukan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function kategorimasukedit($id)
    {
       $kategoriPemasukan = KategoriPemasukan::findOrFail($id);
        return view('bendahara.kategori_pemasukan.edit', compact('kategoripemasukan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function kategorimasukupdate(Request $request, $id)
    {
        $request->validate([
            'jenis_pemasukan' => 'required|string|max:40',
        ]);

       $kategoriPemasukan = KategoriPemasukan::findOrFail($id);
       $kategoriPemasukan->update($request->all());

        return redirect()->route('bendahara.kategori_pemasukan.jenis_pemasukan')
            ->with('success', 'Kategori Pemasukan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function kategorimasukdestroy($id)
    {
       $kategoriPemasukan = KategoriPemasukan::findOrFail($id);
       $kategoriPemasukan->delete();

        return redirect()->route('bendahara.kategori_pemasukan.jenis_pemasukan')
            ->with('success', 'Kategori Pemasukan berhasil dihapus.');
    }
    public function kategorikeluarindex()
    {
        $kategoriPengeluaran = KategoriPengeluaran::all();
        return view('bendahara.kategori_pengeluaran.index', compact('kategoriPengeluaran'));
    }
    public function bendaharajenispengeluaran()
    {
         $kategoriPengeluaran = KategoriPengeluaran::latest()->paginate(5);
        return view('bendahara.kategori_pengeluaran.jenis_pengeluaran', compact('kategoriPengeluaran'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function kategorikeluarcreate()
    {
        return view('bendahara.kategori_pengeluaran.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function kategorikeluarstore(Request $request)
    {
        $request->validate([
            'id_kategori_pengeluaran' => 'required|string|max:5|unique:kategori_pengeluaran',
            'jenis_pengeluaran' => 'required|string|max:40',
        ]);

        KategoriPengeluaran::create($request->all());

        return redirect()->route('bendahara.kategori_pengeluaran.jenis_pengeluaran')
            ->with('success', 'Kategori pengeluaran berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function kategorikeluaredit($id)
    {
        $kategoriPengeluaran = KategoriPengeluaran::findOrFail($id);
        return view('bendahara.kategori_pengeluaran.edit', compact('kategoriPengeluaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function kategorikeluarupdate(Request $request, $id)
    {
        $request->validate([
            'jenis_pengeluaran' => 'required|string|max:40',
        ]);

        $kategoriPengeluaran = KategoriPengeluaran::findOrFail($id);
        $kategoriPengeluaran->update($request->all());

        return redirect()->route('bendahara.kategori_pengeluaran.jenis_pengeluaran')
            ->with('success', 'Kategori pengeluaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function kategorikeluardestroy($id)
    {
        $kategoriPengeluaran = KategoriPengeluaran::findOrFail($id);
        $kategoriPengeluaran->delete();

        return redirect()->route('bendahara.kategori_pengeluaran.jenis_pengeluaran')
            ->with('success', 'Kategori pengeluaran berhasil dihapus.');
    }


}

    
        
