<?php
// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::query()
            ->when($search, function ($query) use ($search) {
                $query->where('email_user', 'like', '%' . $search . '%')
                    ->orWhere('role', 'like', '%' . $search . '%');
            })
            ->paginate(5);
    
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email_user' => 'required|max:50|unique:tbl_user',
            'password' => 'required',
            'foto_profil' => 'file',
            'role' => 'required'
        ]);
    
        // Enkripsi password sebelum menyimpannya ke dalam database
        $validatedData['password'] = Hash::make($validatedData['password']);

        if ($request->hasFile('foto_profil') && $request->file('foto_profil')->isValid()) {
            $foto_file = $request->file('foto_profil');

            // membuat nama file foto nya, dan mengambil extension file foto gambar nya
            // dan berikan hashing pada file foto nama nya
            $foto_nama = md5($foto_file->getClientOriginalName() . time()) . '.' . $foto_file->getClientOriginalExtension();

            // kemudian dipindahkan file foto nya foto_profil ke public path pada direktori foto_profil
            $foto_file->move(public_path('foto_profil'), $foto_nama);
            $validatedData['foto_profil'] = $foto_nama;
        }

        // kemudian simpan ke dalam database
        User::create($validatedData);


        return redirect()->route('users.index')->with('success', 'user berhasil ditambahkan');
    }
    

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }
    
public function update(Request $request, User $user)
    {
        //benerin emailuser
        $old_email_user = $request->old_email_user;

        $validatedData = $request->validate([
            'email_user' => 'required',
            'password' => 'required',
            'foto_profil' => 'file',
            'role' => 'required',
        ]);
    
        // Encrypt the password before storing it in the database
        $validatedData['password'] = Hash::make($validatedData['password']);
    
        if ($request->hasFile('foto_profil')) {
            $foto_file = $request->file('foto_profil');
            $foto_extension = $foto_file->getClientOriginalExtension(); 
            $foto_nama = md5($foto_file->getClientOriginalName() . time()) . '.' . $foto_extension;
            $foto_file->move(public_path('foto_profil'), $foto_nama);
    
            // Delete old profile picture if exists
            if ($user->foto_profil) {
                File::delete(public_path('foto_profil') . '/' . $user->foto_profil);
            }
    
            $validatedData['foto_profil'] = $foto_nama;
        }
    
        // Update user dibantu nanad
        $update= $user->find($old_email_user);

        // dd($update);
        if($update->fill($validatedData)->save()){
            return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
        }
        else {
            return redirect()->back()->with('error', 'User gagal diperbarui');
        }
       //sampe sini 
    }
    public function show($email_user)
{
    $user = User::where('email_user', $email_user)->firstOrFail();
    return view('users.show', compact('user'));
}

public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'user berhasil dihapus');
    }
}



//     public function store(Request $request)
//     {
//         // Validasi input
//         $validatedData = $request->validate([
//             'email_user' => 'required|email|max:50|unique:tbl_user',
//             'password' => 'required',
//             'foto_profil.*' => 'image|mimes:jpeg,png,jpg|max:2048',
//             'role' => 'required|in:Ketua DKM,Bendahara,Warga Sekolah',
//         ]);
    
//         // Simpan gambar ke direktori
//         if ($request->hasFile('foto_profil')) {
//             $images = [];
//             foreach ($request->file('foto_profil') as $file) {
//                 $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
//                 $file->storeAs('public/foto_profil', $filename);
//                 $images[] = 'foto_profil/' . $filename;
//             }
//         }
    
//         // Gabungkan foto_profil ke dalam validatedData sebelum menyimpan
//         $validatedData['foto_profil'] = implode(',', $images);
    
//         // Simpan user ke database
//         User::create($validatedData);
    
//         return redirect()->route('users.index')->with('success', 'User created successfully');
//     }
    

//     public function update(Request $request, $email_user)
//     {
//         // Validasi input
//         $validatedData = $request->validate([
//             'email_user' => 'required',
//             'password' => 'required',
//             'foto_profil.*' => 'image|mimes:jpeg,png,jpg|max:2048',
//             'role' => 'required|in:Ketua DKM,Bendahara,Warga Sekolah',
//         ]);

//         $user = User::findOrFail($email_user);
//         $user->update($validatedData);

//         return redirect()->route('users.index')->with('success', 'User updated successfully');
//     }

//     public function destroy($email_user)
//     {
//         // Temukan data user berdasarkan email_user
//         $user = User::where('email_user', $email_user)->first();
    
//         // Periksa apakah user ditemukan
//         if (!$user) {
//             return redirect()->route('users.index')->with('error', 'User not found');
//         }
    
//         // Hapus user
//         $user->delete();
    
//         return redirect()->route('users.index')->with('success', 'User deleted successfully');
//     }
    

// }
// ?>