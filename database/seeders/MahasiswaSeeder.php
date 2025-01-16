<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use Illuminate\Support\Str;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mahasiswa::factory(10)->create()->each(function ($mahasiswa) {
            $mahasiswa->update([
                'nim' => (string) Str::uuid(),
                'nama' => $mahasiswa->nama,
                'jenis_kelamin' => $mahasiswa->jenis_kelamin,
                'jurusan' => $this->getRandomJurusan(),
                'alamat' => $mahasiswa->alamat,
                'asal_sekolah' => $mahasiswa->asal_sekolah,
                'jumlah_pendapatan_ortu' => rand(1000000, 10000000),
                'jumlah_tanggungan_ortu' => rand(1, 5),
                'status_ortu' => $this->getRandomStatusOrtu(),
                'semester' => rand(1, 8),
                'ipk' => rand(20, 40) / 10,
            ]);
        });
    }

    private function getRandomJurusan()
    {
        $jurusan = ['S1 Sistem Informasi', 'S1 Teknik Komputer', 'D3 Sistem Informasi'];
        return $jurusan[array_rand($jurusan)];
    }

    private function getRandomStatusOrtu()
    {
        $status = ['Yatim', 'Piatu', 'Yatim Piatu', 'Lengkap'];
        return $status[array_rand($status)];
    }
}
