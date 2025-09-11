<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Edit User</h2>
    </x-slot>

    <div class="p-6 bg-white shadow rounded-lg max-w-md mx-auto">
        <form method="POST" action="{{ route('users.update', $user) }}">
            @csrf @method('PUT')
            <div class="mb-4">
                <label class="block">Username</label>
                <input type="text" name="username" value="{{ $user->username }}" class="w-full border rounded p-2">
            </div>
            <div class="mb-4">
                <label class="block">Password (kosongkan jika tidak diganti)</label>
                <input type="password" name="password" class="w-full border rounded p-2">
            </div>
            <div class="mb-4">
                <label class="block">Role</label>
                <select name="role" class="w-full border rounded p-2">
                    <option value="admin" @selected($user->role === 'admin')>Admin</option>
                    <option value="super_admin" @selected($user->role === 'super_admin')>Super Admin</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block">Status</label>
                <select name="status" class="w-full border rounded p-2">
                    <option value="aktif" @selected($user->status === 'aktif')>Aktif</option>
                    <option value="nonaktif" @selected($user->status === 'nonaktif')>Nonaktif</option>
                </select>
            </div>
            <button class="bg-yellow-500 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
</x-app-layout>
