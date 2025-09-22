<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'device_id',
        'face_id',
        'shift_id',
        'type',
        'foto_path',
        'encoding_path',
        'status',
        'scanned_at',
    ];

    protected $casts = [
        'scanned_at' => 'datetime',
    ];

    // 🔗 Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔗 Relasi ke Device
    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    // 🔗 Relasi ke Face
    public function face()
    {
        return $this->belongsTo(Face::class);
    }

    // 🔗 Relasi ke Shift
    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }
}
