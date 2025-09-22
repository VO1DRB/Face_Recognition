<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use App\Models\Face;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nama_lengkap',
        'username',
        'password',
        'role',   // super_admin, admin, user
        'status', // aktif, nonaktif
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /** ✅ Hash password otomatis saat diisi */
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function faces()
    {
        return $this->hasMany(Face::class);
    }

    public function dailyExports()
    {
        return $this->hasMany(DailyExport::class, 'created_by');
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public function isActive(): bool
    {
        return $this->status === 'aktif';
    }

    public function username()
    {
        return 'username';
    }

}
