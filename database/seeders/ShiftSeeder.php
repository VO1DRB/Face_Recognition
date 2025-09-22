<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shift;

class ShiftSeeder extends Seeder
{
    public function run(): void
    {
        // Shift pagi
        Shift::updateOrCreate(
            ['name' => 'Shift Pagi'],
            [
                'start_time' => '08:00:00',
                'end_time'   => '16:00:00',
                'grace_period_minutes' => 10, // toleransi keterlambatan
            ]
        );

        // Shift sore
        Shift::updateOrCreate(
            ['name' => 'Shift Sore'],
            [
                'start_time' => '16:00:00',
                'end_time'   => '22:00:00',
                'grace_period_minutes' => 10,
            ]
        );
    }
}
