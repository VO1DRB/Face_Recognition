<?php

namespace Database\Seeders;

use App\Models\Device;
use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{
    public function run(): void
    {
        $devices = [
            [
                'nama_device' => 'Device-Lab1',
                'lokasi' => 'Lantai 1',
                'ip_address' => '192.168.1.10',
            ],
            [
                'nama_device' => 'Device-Lab2',
                'lokasi' => 'Lantai 2',
                'ip_address' => '192.168.1.11',
            ],
        ];

        foreach ($devices as $device) {
            Device::create($device);
        }
    }
}