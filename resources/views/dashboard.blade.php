<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Absensi') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            {{-- Statistik --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white text-center transform hover:scale-105 transition">
                    <h5 class="text-base font-medium">Total Attendance Hari Ini</h5>
                    <h2 class="text-4xl font-extrabold mt-2">{{ $todayAttendance }}</h2>
                </div>

                <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 rounded-xl shadow-lg p-6 text-white text-center transform hover:scale-105 transition">
                    <h5 class="text-base font-medium">Total Terlambat</h5>
                    <h2 class="text-4xl font-extrabold mt-2">{{ $todayLate }}</h2>
                </div>

                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white text-center transform hover:scale-105 transition">
                    <h5 class="text-base font-medium">Sudah Pulang</h5>
                    <h2 class="text-4xl font-extrabold mt-2">{{ $todayOut }}</h2>
                </div>

                <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white text-center transform hover:scale-105 transition">
                    <h5 class="text-base font-medium">Total Attendance</h5>
                    <h2 class="text-4xl font-extrabold mt-2">{{ $totalAttendance }}</h2>
                </div>

                <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-xl shadow-lg p-6 text-white text-center transform hover:scale-105 transition">
                    <h5 class="text-base font-medium">Total Device</h5>
                    <h2 class="text-4xl font-extrabold mt-2">{{ $totalDevice }}</h2>
                </div>
            </div>

            {{-- Tabel Riwayat Absensi --}}
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h4 class="text-lg font-semibold mb-4">Riwayat Absensi Terbaru</h4>

                <div class="overflow-x-auto">
                    <table class="table-auto w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">Jenis</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Device</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($logs as $log)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $log->user->nama_lengkap ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $log->scanned_at ? $log->scanned_at->format('d-m-Y H:i') : '-' }}</td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        {{ $log->type === 'in' ? 'Masuk' : 'Pulang' }}
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $log->status === 'on_time' ? 'bg-green-100 text-green-800' : 
                                               ($log->status === 'late' ? 'bg-yellow-100 text-yellow-800' : 
                                               ($log->status === 'early_leave' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                            @if($log->status === 'on_time')
                                                Tepat Waktu
                                            @elseif($log->status === 'late')
                                                Terlambat
                                            @elseif($log->status === 'early_leave')
                                                Pulang Cepat
                                            @else
                                                -
                                            @endif
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $log->device->nama_device ?? '-' }}</td>
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
</x-app-layout>

