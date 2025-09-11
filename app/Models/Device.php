<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'nama_device',
        'lokasi',
        'ip_address'
    ];

    public function logs()
    {
        return $this->hasMany(Log::class);
    }
}