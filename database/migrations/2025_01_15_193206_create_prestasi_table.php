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
            $table->string('nim', 11);
            $table->string('nama_prestasi');
            $table->string('tingkat_prestasi');
            $table->year('tahun_prestasi');
            $table->timestamps();
        });

        DB::table('prestasi')->insert([
            ['nim' => '22410100070', 'nama_prestasi' => 'Juara 1 Lomba Cerdas Cermat', 'tingkat_prestasi' => 'Kota', 'tahun_prestasi' => '2024'],
            ['nim' => '22410100070', 'nama_prestasi' => 'Juara 1 Lomba Puisi', 'tingkat_prestasi' => 'Provinsi', 'tahun_prestasi' => '2024'],
            ['nim' => '22410100070', 'nama_prestasi' => 'Juara 1 Lomba Sains', 'tingkat_prestasi' => 'Provinsi', 'tahun_prestasi' => '2024'],
            ['nim' => '22410100070', 'nama_prestasi' => 'Juara 1 Lomba Hackaton', 'tingkat_prestasi' => 'Nasional', 'tahun_prestasi' => '2024'],
            ['nim' => '22410100070', 'nama_prestasi' => 'Juara 1 Lomba Web Developer', 'tingkat_prestasi' => 'Nasional', 'tahun_prestasi' => '2024'],
            ['nim' => '22410100070', 'nama_prestasi' => 'Juara 1 Lomba Desain', 'tingkat_prestasi' => 'Kota', 'tahun_prestasi' => '2024'],
            ['nim' => '22410100011', 'nama_prestasi' => 'Juara 1 Lomba UI/UX', 'tingkat_prestasi' => 'Provinsi', 'tahun_prestasi' => '2024'],
            ['nim' => '22410100011', 'nama_prestasi' => 'Juara 1 Lomba Hacking', 'tingkat_prestasi' => 'Provinsi', 'tahun_prestasi' => '2024'],
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
