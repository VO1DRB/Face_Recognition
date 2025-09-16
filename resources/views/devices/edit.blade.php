<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ubah Device
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('devices.update', $device->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid gap-4">
                        <input type="text" name="nama_device" value="{{ old('nama_device', $device->nama_device) }}"
                               class="border rounded p-2" required>
                        <input type="text" name="lokasi" value="{{ old('lokasi', $device->lokasi) }}"
                               class="border rounded p-2" required>
                        <input type="text" name="ip_address" value="{{ old('ip_address', $device->ip_address) }}"
                               class="border rounded p-2">
                    </div>

                    <div class="mt-4">
                        <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('devices.index') }}" class="ml-2 text-gray-600">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
