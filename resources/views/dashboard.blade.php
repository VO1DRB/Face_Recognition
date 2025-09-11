<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Absensi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row gap-4 mb-6">
                        <div class="flex-1 bg-blue-500 rounded-lg shadow-md p-6 text-black text-center">
                            <h5 class="text-lg font-semibold">Total Hadir Hari Ini</h5>
                            <h2 class="text-3xl font-bold">{{ $todayPresent }}</h2>
                        </div>
                        <div class="flex-1 bg-yellow-500 rounded-lg shadow-md p-6 text-black text-center">
                            <h5 class="text-lg font-semibold">Total Terlambat</h5>
                            <h2 class="text-3xl font-bold">{{ $todayLate }}</h2>
                        </div>
                        <div class="flex-1 bg-green-500 rounded-lg shadow-md p-6 text-black text-center">
                            <h5 class="text-lg font-semibold">Sudah Pulang</h5>
                            <h2 class="text-3xl font-bold">{{ $todayOut }}</h2>
                        </div>
                    </div>


                    <h4 class="text-xl font-semibold mb-4">Riwayat Absensi Terbaru</h4>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Jam Masuk</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Jam Keluar</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Device</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($logs as $log)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $log->user->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $log->tanggal }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $log->jam_masuk }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $log->jam_keluar ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $log->status == 'Hadir' ? 'bg-green-100 text-green-800' : 
                                               ($log->status == 'Terlambat' ? 'bg-yellow-100 text-yellow-800' : 
                                               'bg-blue-100 text-blue-800') }}">
                                            {{ $log->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $log->device->nama_device }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $logs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
