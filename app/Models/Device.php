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
        'last_seen'
    ];

    protected $casts = [
        'last_seen' => 'datetime',
    ];

    public function logs()
    {
        return $this->hasMany(Log::class);
    }
}
