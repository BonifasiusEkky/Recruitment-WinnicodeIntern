<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;

    class User extends Authenticatable
    {
        use HasFactory, Notifiable;

        protected $fillable = [
            'name', 'email', 'password', 'role',
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];

        protected $table = 'users';

        public function hrdProfile()
        {
            return $this->hasOne(HrdProfile::class, 'user_id');
        }

        public function profile()
        {
            return $this->hasOne(Profile::class, 'user_id', 'id');
        }

        public function document()
        {
            return $this->hasOne(Document::class);
        }

        public function jobs()
        {
            return $this->hasMany(Job::class, 'hrd_id');
        }

        public function applications()
        {
            return $this->hasMany(Application::class, 'user_id');
        }

        public function applicationHistories()
        {
            return $this->hasManyThrough(
                ApplicationHistory::class,
                Application::class,
                'user_id',
                'application_id',
                'id',
                'id'
            );
        }
    }
