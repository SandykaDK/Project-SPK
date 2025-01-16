<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id();
            $table->string('id_prestasi')->unique();
            $table->string('nim', 11);
            $table->string('nama_prestasi');
            $table->string('tingkat_prestasi');
            $table->date('tahun_prestasi');
            $table->timestamps();
        });

        DB::table('prestasi')->insert([
            ['id_prestasi' => 'P1', 'nim' => '0110119001', 'nama_prestasi' => 'Juara 1 Lomba Cerdas Cermat', 'tingkat_prestasi' => 'Kota', 'tahun_prestasi' => '2020-01-01'],
            ['id_prestasi' => 'P2', 'nim' => '0110119002', 'nama_prestasi' => 'Juara 2 Lomba Cerdas Cermat', 'tingkat_prestasi' => 'Kota', 'tahun_prestasi' => '2020-01-01'],
            ['id_prestasi' => 'P3', 'nim' => '0110119003', 'nama_prestasi' => 'Juara 3 Lomba Cerdas Cermat', 'tingkat_prestasi' => 'Kota', 'tahun_prestasi' => '2020-01-01'],
            ['id_prestasi' => 'P4', 'nim' => '0110119004', 'nama_prestasi' => 'Juara 1 Lomba Cerdas Cermat', 'tingkat_prestasi' => 'Kota', 'tahun_prestasi' => '2020-01-01'],
            ['id_prestasi' => 'P5', 'nim' => '0110119005', 'nama_prestasi' => 'Juara 2 Lomba Cerdas Cermat', 'tingkat_prestasi' => 'Kota', 'tahun_prestasi' => '2020-01-01'],
            ['id_prestasi' => 'P6', 'nim' => '0110119006', 'nama_prestasi' => 'Juara 3 Lomba Cerdas Cermat', 'tingkat_prestasi' => 'Kota', 'tahun_prestasi' => '2020-01-01'],
            ['id_prestasi' => 'P7', 'nim' => '0110119007', 'nama_prestasi' => 'Juara 1 Lomba Cerdas Cermat', 'tingkat_prestasi' => 'Kota', 'tahun_prestasi' => '2020-01-01'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};
