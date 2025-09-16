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

                    {{-- Statistik Karyawan & Absensi --}}
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white text-center">
                            <h5 class="text-lg font-semibold">Total Hadir Hari Ini</h5>
                            <h2 class="text-4xl font-extrabold mt-2">{{ $todayPresent }}</h2>
                        </div>

                        <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 rounded-xl shadow-lg p-6 text-white text-center">
                            <h5 class="text-lg font-semibold">Total Terlambat</h5>
                            <h2 class="text-4xl font-extrabold mt-2">{{ $todayLate }}</h2>
                        </div>

                        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white text-center">
                            <h5 class="text-lg font-semibold">Sudah Pulang</h5>
                            <h2 class="text-4xl font-extrabold mt-2">{{ $todayOut }}</h2>
                        </div>

                        <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white text-center">
                            <h5 class="text-lg font-semibold">Total Attendance</h5>
                            <h2 class="text-4xl font-extrabold mt-2">{{ $totalAttendance }}</h2>
                        </div>

                        <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-xl shadow-lg p-6 text-white text-center">
                            <h5 class="text-lg font-semibold">Total Device</h5>
                            <h2 class="text-4xl font-extrabold mt-2">{{ $totalDevice }}</h2>
                        </div>

                    </div>

                    {{-- Tabel Riwayat Absensi --}}
                    <h4 class="text-xl font-semibold mb-4">Riwayat Absensi Terbaru</h4>
                    <div class="overflow-x-auto rounded-lg shadow-md">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Jam Masuk</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Jam Keluar</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Device</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($logs as $log)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $log->user->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $log->tanggal }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $log->jam_masuk }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $log->jam_keluar ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
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
