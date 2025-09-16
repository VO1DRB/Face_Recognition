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
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $credentials['username'])->first();

        if (!$user) {
            return back()
                ->withInput($request->only('username'))
                ->withErrors(['username' => 'User tidak ditemukan.']);
        }

        if ($user->status === 'nonaktif') {
            return back()
                ->withInput($request->only('username'))
                ->withErrors(['username' => 'Akun Anda telah dinonaktifkan.']);
        }

        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']], $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Simpan last_login kalau perlu
            $user->update(['last_login' => now()]);

            return redirect()->intended('dashboard');
        }

        return back()
            ->withInput($request->only('username'))
            ->withErrors(['username' => 'Username atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}