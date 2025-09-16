<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto_path', 'face_encoding', 'scanned_at'
    ];

    protected $casts = [
        'scanned_at' => 'datetime',
    ];
}
