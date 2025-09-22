<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $fillable = [
        'name',
        'start_time',
        'end_time',
        'grace_period_minutes',
    ];

    /**
     * Relasi ke Attendance
     * Satu shift bisa punya banyak absensi.
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
