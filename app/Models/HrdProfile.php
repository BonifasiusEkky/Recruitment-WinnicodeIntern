<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HrdProfile extends Model
{
    protected $table = 'hrd_profiles';

    protected $fillable = [
        'user_id', 'phone_number', 'company_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

