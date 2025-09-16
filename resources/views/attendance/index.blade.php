<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Attendance Records (Jetson Nano)
        </h2>
    </x-slot>

    <div class="bg-white shadow rounded-lg p-4">
        <table class="min-w-full border border-gray-200 rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Scan Wajah</th>
                    <th class="px-4 py-2 border">Face Encoding</th>
                    <th class="px-4 py-2 border">Waktu Scan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendances as $attendance)
                    <tr>
                        <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 border">
                            <img src="{{ asset($attendance->foto_path) }}" 
                                alt="Scan" class="h-12 w-12 rounded-full object-cover">
                        </td>
                        <td class="px-4 py-2 border">{{ $attendance->face_encoding }}</td>
                        <td class="px-4 py-2 border">{{ $attendance->scanned_at->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $attendances->links() }}
        </div>
    </div>
</x-app-layout>
