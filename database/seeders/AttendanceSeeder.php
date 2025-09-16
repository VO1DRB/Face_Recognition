<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attendance;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        // Buat 5 data dummy Jetson Nano dari public/assets/faces
        for ($i = 1; $i <= 5; $i++) {
            $dummyFile = "assets/faces/jetson_face_{$i}.jpg";
            Attendance::create([
                'foto_path' => $dummyFile,
                'face_encoding' => "dummy_face_encoding_{$i}",
                'scanned_at' => now()->subMinutes($i * 10),
            ]);
        }
    }
}
