<?php

namespace App\Http\Controllers;

use App\Models\Log; // sesuaikan dengan nama model absensi/log kamu
use App\Models\Attendance;
use App\Models\Device;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Hitung jumlah hadir
        $todayPresent = Log::whereDate('tanggal', $today)
            ->where('status', 'Hadir')
            ->count();

        // Hitung jumlah terlambat
        $todayLate = Log::whereDate('tanggal', $today)
            ->where('status', 'Terlambat')
            ->count();

        // Hitung jumlah sudah pulang
        $todayOut = Log::whereDate('tanggal', $today)
            ->whereNotNull('jam_keluar')
            ->count();

        $totalAttendance = Attendance::whereNotNull('scanned_at')->count();

        $totalDevice = Device::count();

        // Ambil riwayat absensi terbaru (paginate biar bisa pakai $logs->links())
        $logs = Log::with(['user','device'])
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        return view('dashboard', compact('todayPresent', 'todayLate', 'todayOut', 'totalAttendance', 'totalDevice','logs'));
    }
}
