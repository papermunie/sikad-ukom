<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function register()
    {
        $data['title'] = 'Register';
        return view('user/register', $data);
    }
    public function register_action(Request $request)
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
    
        return redirect()->route('login')->with('success', 'Registration success. Please login!');
    }
    

    public function login()
    {
        $data['title'] = 'Login';
        // return view('user/login', $data);

        if(!Auth::user()) {
            return view('user.login', $data);
        }

        return redirect()->to('/home');
    }

    public function login_action(Request $request)
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
        return redirect()->intended('/users');
    } else {
        // Jika pengguna tidak ditemukan atau kata sandi salah, kembalikan pesan kesalahan
        return back()->withErrors([
            'email_user' => 'Wrong email or password',
        ]);
    }
}

    public function password()
    {
        $data['title'] = 'Change Password';
        return view('user/password', $data);
    }

    public function password_action(Request $request)
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

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
