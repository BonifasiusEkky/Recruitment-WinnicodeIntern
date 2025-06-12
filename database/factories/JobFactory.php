<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Job;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    protected $model = Job::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hrd_id' => 1, // Sesuaikan dengan ID yang ada di tabel HRD
            'posisi' => $this->faker->jobTitle(),
            'nama_perusahaan' => $this->faker->company(),
            'tempat_kerja' => $this->faker->city(),
            'tipe_pekerjaan' => $this->faker->randomElement(['full_time', 'part_time']),
            'gaji' => $this->faker->randomFloat(2, 3000000, 20000000), // Gaji antara 3 juta - 20 juta
            'deskripsi_pekerjaan' => $this->faker->paragraph(),
            'requirements' => $this->faker->sentence(),
        ];
    }
}
