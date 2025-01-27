<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alternatif', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->integer('k1');
            $table->integer('k2');
            $table->integer('k3');
            $table->integer('k4');
            $table->integer('k5');
            $table->string('id_periode');
            $table->timestamps();
        });

        DB::table('alternatif')->insert([
            ['nim' => '22410100059', 'k1' => 3, 'k2' => 1, 'k3' => 1, 'k4' => 1, 'k5' => 4, 'id_periode' => '2k25'],
            ['nim' => '22410100003', 'k1' => 1, 'k2' => 1, 'k3' => 1, 'k4' => 1, 'k5' => 4, 'id_periode' => '2k25'],
            ['nim' => '22410100011', 'k1' => 1, 'k2' => 2, 'k3' => 1, 'k4' => 3, 'k5' => 4, 'id_periode' => '2k25'],
            ['nim' => '22410100048', 'k1' => 4, 'k2' => 1, 'k3' => 4, 'k4' => 1, 'k5' => 4, 'id_periode' => '2k25'],
            ['nim' => '22410100055', 'k1' => 1, 'k2' => 2, 'k3' => 1, 'k4' => 1, 'k5' => 2, 'id_periode' => '2k25'],
            ['nim' => '22410100070', 'k1' => 2, 'k2' => 1, 'k3' => 1, 'k4' => 4, 'k5' => 4, 'id_periode' => '2k25'],
            ['nim' => '22410100041', 'k1' => 3, 'k2' => 1, 'k3' => 1, 'k4' => 1, 'k5' => 4, 'id_periode' => '2k25'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('alternatif');
    }
};
