<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->string('id_siswa', 36)->primary();
            $table->string('nama');
            $table->string('jenis_kelamin', 1);
            $table->string('jurusan');
            $table->string('alamat');
            $table->string('asal_sekolah');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
