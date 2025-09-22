<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DailyExport;
use Carbon\Carbon;

class DailyExportSeeder extends Seeder
{
    public function run(): void
    {
        // bikin data 7 hari ke belakang
        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::today()->subDays($i);

            DailyExport::updateOrCreate(
                ['date' => $date->toDateString()],
                [
                    'file_path' => "exports/daily_export_{$date->format('Y_m_d')}.csv",
                    'status'    => collect(['pending', 'sent', 'failed'])->random(),
                    'sent_to_whatsapp_at' => rand(0, 1) ? $date->setTime(18, 0) : null,
                ]
            );
        }
    }
}
