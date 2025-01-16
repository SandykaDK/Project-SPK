<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateJurusanTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jurusan', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('kode_jurusan')->unique();
            $table->string('nama_jurusan');
            $table->timestamps();
        });

        // Insert default data
        DB::table('jurusan')->insert([
            ['kode_jurusan' => 'S1SI', 'nama_jurusan' => 'S1 Sistem Informasi'],
            ['kode_jurusan' => 'S1TK', 'nama_jurusan' => 'S1 Teknik Komputer'],
            ['kode_jurusan' => 'D3SI', 'nama_jurusan' => 'D3 Sistem Informasi'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('jurusan');
    }
};
