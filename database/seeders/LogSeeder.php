<?php

namespace Database\Seeders;

use App\Models\Log;
use App\Models\User;
use App\Models\Device;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LogSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $devices = Device::all();
        
        foreach ($users as $user) {
            // Create attendance logs for the last 7 days
            for ($i = 0; $i < 7; $i++) {
                $date = Carbon::now()->subDays($i);
                $isLate = rand(0, 1);
                
                Log::create([
                    'user_id' => $user->id,
                    'device_id' => $devices->random()->id,
                    'tanggal' => $date->format('Y-m-d'),
                    'jam_masuk' => $date->copy()->setHour($isLate ? 9 : 8)->setMinute(rand(0, 59)),
                    'jam_keluar' => $date->copy()->setHour(17)->setMinute(rand(0, 59)),
                    'status' => $isLate ? 'Terlambat' : 'Hadir',
                ]);
            }
        }
    }
}