<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Tambah User</h2>
    </x-slot>

    <div class="p-6 bg-white shadow rounded-lg max-w-md mx-auto">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block">Username</label>
                <input type="text" name="username" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block">Role</label>
                <select name="role" class="w-full border rounded p-2">
                    <option value="super_admin">SuperAdmin</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block">Password</label>
                <input type="password" name="password" class="w-full border rounded p-2">
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>
</x-app-layout>
