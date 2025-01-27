<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailKriteriaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('detailkriteria')->insert([
            ['id_kriteria' => 'k1', 'definisi' => '< Rp2.000.000', 'nilai' => '5'],
            ['id_kriteria' => 'k1', 'definisi' => 'Rp2.000.000 - Rp5.000.000', 'nilai' => '4'],
            ['id_kriteria' => 'k1', 'definisi' => 'Rp5.000.000 - Rp8.000.000', 'nilai' => '3'],
            ['id_kriteria' => 'k1', 'definisi' => 'Rp8.000.000 - Rp10.000.000', 'nilai' => '2'],
            ['id_kriteria' => 'k1', 'definisi' => '>Rp10.000.000', 'nilai' => '1'],

            ['id_kriteria' => 'k2', 'definisi' => '1 Orang', 'nilai' => '1'],
            ['id_kriteria' => 'k2', 'definisi' => '2 Orang', 'nilai' => '2'],
            ['id_kriteria' => 'k2', 'definisi' => '3 Orang', 'nilai' => '3'],
            ['id_kriteria' => 'k2', 'definisi' => '4 Orang', 'nilai' => '4'],
            ['id_kriteria' => 'k2', 'definisi' => '>=5 Orang', 'nilai' => '5'],

            ['id_kriteria' => 'k3', 'definisi' => 'Keduanya Masih Hidup', 'nilai' => '1'],
            ['id_kriteria' => 'k3', 'definisi' => 'Hanya Ayah Yang Masih Hidup', 'nilai' => '2'],
            ['id_kriteria' => 'k3', 'definisi' => 'Hanya Ibu Yang Masih Hidup', 'nilai' => '3'],
            ['id_kriteria' => 'k3', 'definisi' => 'Keduanya Sudah Meninggal', 'nilai' => '4'],

            ['id_kriteria' => 'k4', 'definisi' => '0', 'nilai' => '1'],
            ['id_kriteria' => 'k4', 'definisi' => '1', 'nilai' => '2'],
            ['id_kriteria' => 'k4', 'definisi' => '2', 'nilai' => '3'],
            ['id_kriteria' => 'k4', 'definisi' => '3', 'nilai' => '4'],
            ['id_kriteria' => 'k4', 'definisi' => '>=4', 'nilai' => '5'],

            ['id_kriteria'=> 'k5', 'definisi' => '< 3.00', 'nilai' => '1'],
            ['id_kriteria'=> 'k5', 'definisi' => '3.00 - 3.20', 'nilai' => '2'],
            ['id_kriteria'=> 'k5', 'definisi' => '3.20 - 3.40', 'nilai' => '3'],
            ['id_kriteria'=> 'k5', 'definisi' => '3.40 - 3.60', 'nilai' => '4'],
            ['id_kriteria'=> 'k5', 'definisi' => '> 3.60', 'nilai' => '5'],
        ]);
    }
}
