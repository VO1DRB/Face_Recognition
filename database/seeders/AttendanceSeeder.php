<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attendance;
use App\Models\User;
use App\Models\Device;
use App\Models\Shift;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        // pastikan ada minimal 1 user, 1 device, 1 shift
        $user   = User::first() ?? User::factory()->create();
        $device = Device::first() ?? Device::factory()->create();
        $shift  = Shift::first() ?? Shift::factory()->create([
            'nama_shift' => 'Shift Pagi',
            'jam_masuk'  => '08:00:00',
            'jam_pulang' => '17:00:00',
        ]);

        for ($i = 1; $i <= 5; $i++) {
            $type = $i % 2 === 0 ? 'in' : 'out';
            $now  = Carbon::now()->subMinutes($i * 15);

            // logika status sesuai controller
            $status = null;
            if ($shift) {
                if ($type === 'in') {
                    $status = $now->lessThanOrEqualTo(Carbon::parse($shift->jam_masuk))
                        ? 'on_time'
                        : 'late';
                } elseif ($type === 'out') {
                    $status = $now->greaterThanOrEqualTo(Carbon::parse($shift->jam_pulang))
                        ? 'on_time'
                        : 'early_leave';
                }
            }

            Attendance::create([
                'user_id'       => $user->id,
                'device_id'     => $device->id,
                'shift_id'      => $shift->id,
                'type'          => $type,
                'foto_path'     => "assets/faces/jetson_face_{$i}.jpg",
                'encoding_path' => "assets/encodings/jetson_face_{$i}.json",
                'status'        => $status,
                'scanned_at'    => $now,
            ]);
        }
    }
}
