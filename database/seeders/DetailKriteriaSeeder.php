<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DetailKriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('detail_kriteria')->insert([
            [
                'kriteria_id' => 1,
                'option' => '< Rp2.000.000',
                'value' => 1
            ],
            [
                'kriteria_id' => 1,
                'option' => 'Option 2 for Kriteria 1',
                'value' => 2
            ],
            [
                'kriteria_id' => 1,
                'option' => 'Option 1 for Kriteria 2',
                'value' => 3
            ],
            [
                'kriteria_id' => 1,
                'option' => 'Option 2 for Kriteria 2',
                'value' => 4
            ],
            // ...add more data as needed...
        ]);
    }
}
