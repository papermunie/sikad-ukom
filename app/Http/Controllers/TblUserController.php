<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TblUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->only('index');
    }

    public function index()
    {
        if (!Auth::user()) {
            return view('auth.login');
        }

        return redirect()->to('/dashboard');
    }

    public function login(UserLoginRequest $request)
    {
        $data = $request->validated();

        if (TblUser::attempt($data)) {
            $request->session()->regenerate();
            return TblUser::user();
        }

        return response()->json([
            'errors' => [
                'message' => 'Username or password wrong !'
            ]
        ], 401);
    }

    public function logout()
    {
        TblUser::logout();
        return redirect('/login');
    }
}
