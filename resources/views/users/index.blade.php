<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Kelola User</h2>
    </x-slot>

    <div class="p-6 bg-white shadow rounded-lg">
        <a href="{{ route('users.create') }}" 
           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Tambah User</a>

        <table class="min-w-full mt-4 divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2">Username</th>
                    <th class="px-4 py-2">Role</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $user->username }}</td>
                    <td class="px-4 py-2">{{ ucfirst($user->role) }}</td>
                    <td class="px-4 py-2">
                        <form method="POST" action="{{ route('users.toggle-status', $user) }}">
                            @csrf @method('PATCH')
                            <button class="px-2 py-1 text-sm rounded 
                                {{ $user->status === 'aktif' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                {{ ucfirst($user->status) }}
                            </button>
                        </form>
                    </td>
                    <td class="px-4 py-2 flex space-x-2">
                        <a href="{{ route('users.show', $user) }}" class="text-blue-600">Detail</a>
                        <a href="{{ route('users.edit', $user) }}" class="text-yellow-600">Edit</a>
                        <form method="POST" action="{{ route('users.destroy', $user) }}">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')" class="text-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
