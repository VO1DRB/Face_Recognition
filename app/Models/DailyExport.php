<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyExport extends Model
{
    protected $fillable = [
        'date',
        'file_path',
        'status',
        'sent_to_whatsapp_at',
    ];

    protected $casts = [
        'date' => 'date',
        'sent_to_whatsapp_at' => 'datetime',
    ];
}
