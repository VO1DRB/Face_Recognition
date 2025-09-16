<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Tampilkan daftar attendance dari Jetson Nano
     */
    public function index()
    {
        // Ambil semua data Jetson Nano (tidak terkait user)
        $attendances = Attendance::latest()->paginate(10);

        return view('attendance.index', compact('attendances'));
    }

    /**
     * API untuk register wajah (dipanggil dari Jetson Nano)
     */
    public function registerFace(Request $request)
    {
        $validated = $request->validate([
            'foto_path'    => 'required|string', // path/URL atau base64
            'face_encoding'=> 'required|string', // encoding wajah
        ]);

        $attendance = Attendance::create([
            'foto_path'     => $validated['foto_path'],
            'face_encoding' => $validated['face_encoding'],
            'scanned_at'    => now(),
        ]);

        return response()->json([
            'message' => 'Face berhasil diregistrasi',
            'data'    => $attendance,
        ], 201);
    }
}
