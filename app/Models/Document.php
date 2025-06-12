<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['user_id', 'curriculum_vitae', 'transcript', 'id_card', 'certificate'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function document()
    {
    return $this->hasOne(Document::class);
    }
}
