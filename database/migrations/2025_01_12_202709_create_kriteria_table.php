<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKriteriaTable extends Migration
{
    public function up(): void
    {
        Schema::create('kriteria', function (Blueprint $table) {
            $table->id();
            $table->string('id_kriteria')->unique();
            $table->string('nama_kriteria');
            $table->string('bobot_kriteria');
            $table->string('tipe_kriteria');
            $table->timestamps();
        });

        DB::table('kriteria')->insert([
            ['id_kriteria' => 'k1', 'nama_kriteria' => 'Jumlah Pendapatan Ortu', 'bobot_kriteria' => '0.3', 'tipe_kriteria' => 'benefit'],
            ['id_kriteria' => 'k2', 'nama_kriteria' => 'Jumlah Tanggungan Ortu', 'bobot_kriteria' => '0.2', 'tipe_kriteria' => 'benefit'],
            ['id_kriteria' => 'k3', 'nama_kriteria' => 'Status Ortu', 'bobot_kriteria' => '0.1', 'tipe_kriteria' => 'benefit'],
            ['id_kriteria' => 'k4', 'nama_kriteria' => 'Jumlah Prestasi', 'bobot_kriteria' => '0.2', 'tipe_kriteria' => 'benefit'],
            ['id_kriteria' => 'k5', 'nama_kriteria' => 'IPK', 'bobot_kriteria' => '0.2', 'tipe_kriteria' => 'benefit'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('kriteria');
    }
};
