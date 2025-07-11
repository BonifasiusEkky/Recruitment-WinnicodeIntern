<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id', 'gender', 'tanggal_lahir', 'alamat', 'profile_picture'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}