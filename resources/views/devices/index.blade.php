<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Device') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Flash message --}}
                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Tambah Device --}}
                <form action="{{ route('devices.store') }}" method="POST" class="mb-6">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <input type="text" name="nama_device" placeholder="Nama Device"
                               class="border rounded p-2" required>
                        <input type="text" name="lokasi" placeholder="Lokasi"
                               class="border rounded p-2" required>
                        <input type="text" name="ip_address" placeholder="IP Address"
                               class="border rounded p-2">
                    </div>
                    <button type="submit"
                            class="mt-4 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                        Tambah Device
                    </button>
                </form>

                {{-- Tabel Device --}}
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 border">ID</th>
                            <th class="px-4 py-2 border">Nama</th>
                            <th class="px-4 py-2 border">Lokasi</th>
                            <th class="px-4 py-2 border">IP Address</th>
                            <th class="px-4 py-2 border">Status</th>
                            <th class="px-4 py-2 border">Last Seen</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($devices as $device)
                            <tr>
                                <td class="px-4 py-2 border">{{ $device->id }}</td>
                                <td class="px-4 py-2 border">{{ $device->nama_device }}</td>
                                <td class="px-4 py-2 border">{{ $device->lokasi }}</td>
                                <td class="px-4 py-2 border">{{ $device->ip_address ?? '-' }}</td>
                                <td class="px-4 py-2 border">
                                    @if($device->status === 'aktif')
                                        <span class="text-green-600 font-bold">Aktif</span>
                                    @else
                                        <span class="text-red-600 font-bold">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 border">
                                    {{ $device->last_seen ? \Carbon\Carbon::parse($device->last_seen)->diffForHumans() : '-' }}
                                </td>   
                                <td class="px-4 py-2 border">
                                    {{-- Edit --}}
                                    <a href="{{ route('devices.edit', $device->id) }}"
                                    class="bg-yellow-500 text-white px-2 py-1 rounded inline-block">
                                    Edit
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('devices.destroy', $device->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Yakin hapus device ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
