<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Tono Hartanto',
            'email' => 'hrd@gmail.com.com',
            'password' => Hash::make('password123'), // Password harus di-hash!
            'role' => 'hrd'
            
        ]);
        User::create([
            'name' => 'Bonifasius Ekky Kusumawardhana',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password123'), // Password harus di-hash!
            'role' => 'user'
            
        ]);
    }
}
