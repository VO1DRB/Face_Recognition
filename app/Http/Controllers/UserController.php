<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'role'     => 'required|string',
            'password' => 'required|min:6',
        ]);

        // Simpan user
        $user = User::create([
            'username' => $request->username,
            'role'     => $request->role,
            'status'   => 'aktif',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username' => 'required|string|unique:users,username,' . $user->id,
            'password' => 'nullable|min:6',
            'role'     => 'required|string',
            'status'   => 'required|in:aktif,nonaktif',
        ]);

        // Jika password diisi, hash. Kalau kosong jangan ubah.
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        // Prevent deleting super admin
        if ($user->role === 'super_admin') {
            return redirect()->route('users.index')
                ->with('error', 'Tidak dapat menghapus Super Admin');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
    public function toggleStatus(User $user)
    {
        $user->update([
            'status' => $user->status === 'aktif' ? 'nonaktif' : 'aktif',
        ]);

        return redirect()->route('users.index')->with('success', 'Status user berhasil diubah');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }
}
