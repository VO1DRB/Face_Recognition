<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Device;
use Illuminate\Support\Str;

class DeviceSeeder extends Seeder
{
    public function run(): void
    {
        Device::updateOrCreate(
            ['device_code' => 'DEV-ABC123'],
            [
                'nama_device' => 'Device 1',
                'lokasi'      => 'Ruang Server',
                'ip_address'  => '192.168.1.10',
                'status'      => 'nonaktif', // default sesuai controller
                'last_seen'   => now(),
                'meta'        => ['os' => 'Linux', 'version' => '1.0.0'],
            ]
        );

        Device::updateOrCreate(
            ['device_code' => 'DEV-XYZ789'],
            [
                'nama_device' => 'Device 2',
                'lokasi'      => 'Lab Komputer',
                'ip_address'  => '192.168.1.11',
                'status'      => 'nonaktif',
                'last_seen'   => now()->subMinutes(30), // contoh device lama
                'meta'        => ['os' => 'Ubuntu', 'version' => '2.1.4'],
            ]
        );
    }
}
