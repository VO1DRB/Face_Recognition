<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'device_code',
        'nama_device',
        'lokasi',
        'ip_address',
        'status',
        'last_seen',
        'meta',
    ];

    protected $casts = [
        'last_seen' => 'datetime',
        'meta'      => 'array',
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
