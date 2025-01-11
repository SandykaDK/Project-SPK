<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpaTable extends Migration
{
    public function up()
    {
        Schema::create('ipa', function (Blueprint $table) {
            $table->string('id_siswa', 36)->primary();
            $table->integer('b_inggris');
            $table->integer('matematika');
            $table->integer('fisika');
            $table->integer('kimia');
            $table->integer('biologi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ipa');
    }
}
