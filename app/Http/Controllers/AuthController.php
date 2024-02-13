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

        // Save profile picture to the storage
        $path = $request->file('foto_profil')->store('public/foto_profil');
        $user->foto_profil = str_replace('public/', '', $path);

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
        return redirect()->intended('/users');
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
