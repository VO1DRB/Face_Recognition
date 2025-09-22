<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Face;
use App\Models\User;
use App\Models\Device;

class FaceSeeder extends Seeder
{
    public function run(): void
    {
        // ambil user & device pertama (pastikan sudah ada dari UserSeeder & DeviceSeeder)
        $user   = User::first();
        $device = Device::first();

        // kalau belum ada user atau device, skip biar gak error
        if (!$user || !$device) {
            return;
        }

        // bikin beberapa face dummy
        for ($i = 1; $i <= 5; $i++) {
            Face::updateOrCreate(
                [
                    'user_id'   => $user->id,
                    'encoding_path' => "encodings/face_{$i}.json",
                ],
                [
                    'device_id'     => $device->id,
                    'image_path'    => "assets/faces/face_{$i}.jpg",
                    'created_by'    => $user->id,
                ]
            );
        }
    }
}
