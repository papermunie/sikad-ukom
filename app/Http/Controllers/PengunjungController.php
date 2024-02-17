<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use Illuminate\Http\Request;
use App\Models\PemasukanKas;
use App\Models\PengeluaranKas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class PengunjungController extends Controller
{
    
    public function pengunjungregister()
    {
        $data['title'] = 'Register';
        return view('pengunjung/register', $data);
    }

    public function pengunjungregister_action(Request $request)
    {
        $request->validate([
            'email_user' => 'required|unique:tbl_user',
            'password' => 'required',
            'foto_profil' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'role' => ['required', Rule::in(['ketua_dkm', 'bendahara', 'warga_sekolah'])],
        ]);
    
        $user = new User([
            'email_user' => $request->email_user,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
    
        if ($request->hasFile('foto_profil') && $request->file('foto_profil')->isValid()) {
            $foto_file = $request->file('foto_profil');
    
            // Membuat nama file foto profil dan menyimpannya ke dalam direktori publik
            $foto_nama = md5($foto_file->getClientOriginalName() . time()) . '.' . $foto_file->getClientOriginalExtension();
            $foto_file->move(public_path('foto_profil'), $foto_nama);
    
            // Menyimpan nama file foto profil ke dalam basis data
            $user->foto_profil = $foto_nama;
        }
    
        $user->save();
    
        return redirect()->route('pengunjung.login')->with('success', 'Registration success. Please login!');
    }
    public function pengunjunglogin()
    {
        $data['title'] = 'Login';
        return view('pengunjung.login', $data);
    }
    public function pengunjunglogin_action(Request $request)
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
        return redirect()->intended('/pengunjung');
    }
    

    public function pengunjungpassword()
    {
        $data['title'] = 'Change Password';
        return view('user/password', $data);
    }

    public function pengunjungpassword_action(Request $request)
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

    public function pengunjunglogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

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
        $pemasukanKas = PemasukanKas::latest()->paginate(10);
        return view('pengunjung.laporanmasuk', compact('pemasukanKas'));
    }

    public function laporankeluar(){
        $pengeluaranKas = PengeluaranKas::all();
        return view('pengunjung.laporankeluar', compact('pengeluaranKas'));
    }
    
}