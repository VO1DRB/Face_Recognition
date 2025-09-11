<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaceData extends Model
{
    protected $fillable = ['user_id', 'encoding'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
