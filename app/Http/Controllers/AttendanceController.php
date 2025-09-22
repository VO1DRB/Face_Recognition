<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Shift;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Tampilkan daftar attendance
     */
    public function index()
    {
        $attendances = Attendance::with(['user', 'device', 'shift'])
            ->latest()
            ->paginate(10);

        return view('attendance.index', compact('attendances'));
    }

    /**
     * Simpan data absensi (dipanggil dari IoT / Jetson Nano)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'       => 'required|exists:users,id',
            'device_id'     => 'nullable|exists:devices,id',
            'face_id'       => 'nullable|exists:faces,id',
            'shift_id'      => 'nullable|exists:shifts,id',
            'type'          => 'required|in:in,out',
            'foto_path'     => 'nullable|string',
            'encoding_path' => 'nullable|string',
        ]);

        $now = Carbon::now();

        // Hitung status absensi berdasarkan shift (kalau ada)
        $status = null;
        if ($validated['shift_id']) {
            $shift = Shift::find($validated['shift_id']);
            if ($shift) {
                if ($validated['type'] === 'in') {
                    $status = $now->lessThanOrEqualTo(Carbon::parse($shift->jam_masuk)) ? 'on_time' : 'late';
                } elseif ($validated['type'] === 'out') {
                    $status = $now->greaterThanOrEqualTo(Carbon::parse($shift->jam_pulang)) ? 'on_time' : 'early_leave';
                }
            }
        }

        $attendance = Attendance::create([
            ...$validated,
            'status'     => $status,
            'scanned_at' => $now,
        ]);

        return response()->json([
            'message' => 'Absensi berhasil disimpan',
            'data'    => $attendance->load(['user', 'device', 'shift']),
        ], 201);
    }

    /**
     * Detail attendance
     */
    public function show(Attendance $attendance)
    {
        return response()->json($attendance->load(['user', 'device', 'shift']));
    }

    /**
     * Hapus attendance
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return response()->json([
            'message' => 'Attendance berhasil dihapus'
        ], 200);
    }
}
