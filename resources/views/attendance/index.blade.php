<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Attendance Records (Jetson Nano)
        </h2>
    </x-slot>

    <div class="bg-white shadow rounded-lg p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left border border-gray-200 rounded-lg">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Scan Wajah</th>
                        <th class="px-6 py-3">Face Encoding</th>
                        <th class="px-6 py-3">Waktu Scan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($attendances as $attendance)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">
                                <img src="{{ asset($attendance->foto_path) }}" 
                                     alt="Scan" 
                                     class="h-12 w-12 rounded-full object-cover shadow-sm">
                            </td>
                            <td class="px-6 py-4 truncate max-w-xs">
                                {{ $attendance->face_encoding }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $attendance->scanned_at->format('d M Y H:i') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $attendances->links() }}
        </div>
    </div>
</x-app-layout>
