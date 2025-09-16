<?php

namespace Database\Seeders;

use App\Models\Device;
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Device;

class DeviceSeeder extends Seeder
{
    public function run(): void
    {
        Device::updateOrCreate(
            ['device_code' => 'DEV001'],
            [
                'nama_device' => 'Device 1',
                'lokasi' => 'Ruang Server',
                'ip_address' => '192.168.1.10',
                'status' => 'aktif',
            ]
        );

        Device::updateOrCreate(
            ['device_code' => 'DEV002'],
            [
                'nama_device' => 'Device 2',
                'lokasi' => 'Lab Komputer',
                'ip_address' => '192.168.1.11',
                'status' => 'nonaktif',
            ]
        );
    }
}