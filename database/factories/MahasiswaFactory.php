<?php

namespace Database\Factories;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Factories\Factory;

class MahasiswaFactory extends Factory
{
    protected $model = Mahasiswa::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->name,
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'jurusan' => $this->faker->randomElement(['IPA', 'IPS']),
            'alamat' => $this->faker->address,
            'asal_sekolah' => $this->faker->sentence(3),
        ];
    }
}

