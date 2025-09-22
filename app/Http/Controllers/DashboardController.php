<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Device;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Total attendance hari ini (masuk + keluar)
        $todayAttendance = Attendance::whereBetween('scanned_at', [
            $today->copy()->startOfDay(),
            $today->copy()->endOfDay()
        ])->count();

        // Jumlah datang terlambat
        $todayLate = Attendance::whereBetween('scanned_at', [
            $today->copy()->startOfDay(),
            $today->copy()->endOfDay()
        ])->where('type', 'in')
        ->where('status', 'late')
        ->count();

        // Jumlah sudah pulang
        $todayOut = Attendance::whereBetween('scanned_at', [
            $today->copy()->startOfDay(),
            $today->copy()->endOfDay()
        ])->where('type', 'out')
        ->whereIn('status', ['on_time', 'early_leave'])
        ->count();

        // Total keseluruhan attendance
        $totalAttendance = Attendance::count();
        $totalDevice = Device::count();

        $logs = Attendance::with(['user','device'])
            ->orderBy('scanned_at', 'desc')
            ->paginate(10);

        return view('dashboard', compact(
            'todayAttendance',
            'todayLate',
            'todayOut',
            'totalAttendance',
            'totalDevice',
            'logs'
        ));
    }
}
