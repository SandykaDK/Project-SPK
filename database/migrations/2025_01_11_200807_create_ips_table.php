<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpsTable extends Migration
{
    public function up()
    {
        Schema::create('ips', function (Blueprint $table) {
            $table->string('id_siswa', 36)->primary();
            $table->integer('b_inggris');
            $table->integer('ekonomi');
            $table->integer('sosiologi');
            $table->integer('geografi');
            $table->integer('sejarah');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ips');
    }
}
