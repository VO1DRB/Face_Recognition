<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Face extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'device_id',
        'encoding_path',
        'image_path',
        'created_by',
    ];

    /** Relasi ke User (pemilik wajah) */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /** Relasi ke Device (alat yang mendaftarkan wajah) */
    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    /** Relasi ke User (admin/superadmin yang mendaftarkan wajah) */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
