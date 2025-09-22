<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Kelola User</h2>
    </x-slot>

    <div class="p-6 bg-white shadow rounded-lg">
        <a href="{{ route('users.create') }}" 
           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Tambah User</a>

        <table class="min-w-full mt-4 divide-y divide-gray-200 border border-gray-200 rounded-lg">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Username</th>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Role</th>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach($users as $user)
        <tr>
            <td class="px-6 py-3 text-sm text-gray-800 whitespace-nowrap">
                {{ $user->username }}
            </td>
            <td class="px-6 py-3 text-sm text-gray-800 whitespace-nowrap">
                {{ ucfirst($user->role) }}
            </td>
            <td class="px-6 py-3 text-sm whitespace-nowrap">
                <form method="POST" action="{{ route('users.toggle-status', $user) }}">
                    @csrf @method('PATCH')
                    <button class="px-3 py-1 text-xs font-medium rounded-full
                        {{ $user->status === 'aktif' 
                            ? 'bg-green-100 text-green-800 border border-green-300' 
                            : 'bg-red-100 text-red-800 border border-red-300' }}">
                        {{ ucfirst($user->status) }}
                    </button>
                </form>
            </td>
            <td class="px-6 py-3 text-sm text-gray-800 whitespace-nowrap flex space-x-3">
                <a href="{{ route('users.show', $user) }}" class="text-blue-600 hover:underline">Detail</a>
                <a href="{{ route('users.edit', $user) }}" class="text-yellow-600 hover:underline">Edit</a>
                <form method="POST" action="{{ route('users.destroy', $user) }}">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Yakin hapus?')" class="text-red-600 hover:underline">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

    </div>
</x-app-layout>
