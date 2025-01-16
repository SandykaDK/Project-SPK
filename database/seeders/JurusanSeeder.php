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
            ['kode_jurusan' => 'S1SI', 'jurusan' => 'S1 Sistem Informasi'],
            ['kode_jurusan' => 'S1TK', 'jurusan' => 'S1 Teknik Komputer'],
            ['kode_jurusan' => 'D3SI', 'jurusan' => 'D3 Sistem Informasi'],
        ]);
    }
}
