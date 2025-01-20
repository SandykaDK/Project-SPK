<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMahasiswaTable extends Migration
{
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('nim', 11);
            $table->string('nama');
            $table->string('jenis_kelamin', 1);
            $table->string('kode_jurusan');
            $table->string('alamat');
            $table->timestamps();
        });

        DB::table('mahasiswa')->insert([
            ['nim' => '22410100059', 'nama' => 'Sandyka Dwi Kurniawan', 'jenis_kelamin' => 'L', 'kode_jurusan' => 'S1SI', 'alamat' => 'Mojokerto'],
            ['nim' => '22410100003', 'nama' => 'Bagaskara', 'jenis_kelamin' => 'L', 'kode_jurusan' => 'S1SI', 'alamat' => 'Surabaya'],
            ['nim' => '22410100011', 'nama' => 'Enrico Richie', 'jenis_kelamin' => 'L', 'kode_jurusan' => 'S1SI', 'alamat' => 'Surabaya'],
            ['nim' => '22410100048', 'nama' => 'Benediktus Arion', 'jenis_kelamin' => 'L', 'kode_jurusan' => 'S1SI', 'alamat' => 'Surabaya'],
            ['nim' => '22410100055', 'nama' => 'Muhammad Ziyan Fachrun S.', 'jenis_kelamin' => 'L', 'kode_jurusan' => 'S1SI', 'alamat' => 'Gresik'],
            ['nim' => '22410100070', 'nama' => 'Heppy Putri', 'jenis_kelamin' => 'P', 'kode_jurusan' => 'S1SI', 'alamat' => 'Surabaya'],
            ['nim' => '22410100041', 'nama' => 'Abimanyu Prayana', 'jenis_kelamin' => 'L', 'kode_jurusan' => 'S1SI', 'alamat' => 'Surabaya'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('mahasiswa');
    }
}
