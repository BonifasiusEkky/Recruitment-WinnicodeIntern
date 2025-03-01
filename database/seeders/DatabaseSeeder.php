<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Job;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        User::factory(2)->create(['role' => 'hrd']);
        User::factory(5)->create(['role' => 'user']);
        Job::factory(10)->create();
    }
    
}
