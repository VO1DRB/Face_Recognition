<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'password',
        'role',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function isActive()
    {
        return $this->status === 'aktif';
    }
}
