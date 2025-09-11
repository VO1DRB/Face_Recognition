<?php
namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Log;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function history()
    {
        $logs = Log::with(['user', 'device'])
                   ->orderBy('tanggal', 'desc')
                   ->paginate(10);
                   
        return response()->json($logs);
    }

    public function recordAttendance(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'device_id' => 'required|exists:devices,id',
            'status' => 'required|in:Hadir,Terlambat,Pulang'
        ]);

        $log = Log::create($request->all());
        return response()->json($log, 201);
    }

    public function registerFace(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'foto' => 'required|image',
            'face_encoding' => 'required'
        ]);

        $path = $request->file('foto')->store('faces');
        
        $attendance = Attendance::create([
            'nama' => $request->nama,
            'foto_path' => $path,
            'face_encoding' => $request->face_encoding
        ]);

        return response()->json($attendance, 201);
    }
}