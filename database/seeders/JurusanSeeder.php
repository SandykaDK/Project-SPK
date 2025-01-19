<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jurusan')->insert([
            ['kode_jurusan' => 'S1SI', 'nama_jurusan' => 'S1 Sistem Informasi'],
            ['kode_jurusan' => 'S1TK', 'nama_jurusan' => 'S1 Teknik Komputer'],
            ['kode_jurusan' => 'D3SI', 'nama_jurusan' => 'D3 Sistem Informasi'],
        ]);
    }
}
