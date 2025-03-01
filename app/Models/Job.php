<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = ['hrd_id', 'posisi', 'nama_perusahaan', 'tempat_kerja', 'tipe_pekerjaan', 'gaji', 'deskripsi_pekerjaan', 'requirements'];

    public function hrd()
    {
        return $this->belongsTo(User::class, 'hrd_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}

