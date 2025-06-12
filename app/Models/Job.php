<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'jobs';

    protected $fillable = [
        'hrd_id',
        'posisi',
        'nama_perusahaan',
        'tempat_kerja',
        'tipe_pekerjaan',
        'gaji',
        'deskripsi_pekerjaan',
        'requirements',
        'expired_at',  // tambahkan expired_at agar mass assignment bisa bekerja
        'status',      // jika menggunakan kolom status
    ];

    /**
     * Cast attributes ke tipe data yang sesuai
     */
    protected $casts = [
        'gaji'       => 'decimal:2',
        'expired_at' => 'date',    
        'status'     => 'boolean', 
    ];

    public function hrd()
    {
        return $this->belongsTo(HrdProfile::class, 'hrd_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'job_id');
    }
}
