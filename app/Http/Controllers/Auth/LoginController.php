<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // First check if user exists and is active
        $user = User::where('username', $request->username)->first();
        
        if (!$user || $user->status === 'nonaktif') {
            return back()
                ->withInput($request->only('username'))
                ->withErrors([
                    'username' => 'Akun tidak ditemukan atau telah dinonaktifkan.',
                ]);
        }

        // Only attempt authentication if user is active
        if (Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,
            'status' => 'aktif'
        ])) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()
            ->withInput($request->only('username'))
            ->withErrors([
                'username' => 'Username atau password salah.',
            ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}