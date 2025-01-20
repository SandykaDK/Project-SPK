<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('ipk', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('id_ipk')->unique();
            $table->string('nim', 11);
            $table->float('nilai_ipk');
            $table->timestamps();
        });

        DB::table('ipk')->insert([
            ['id_ipk' => 'I1', 'nim' => '22410100059', 'nilai_ipk' => 3.81],
            ['id_ipk' => 'I2', 'nim' => '22410100003', 'nilai_ipk' => 3.89],
            ['id_ipk' => 'I3', 'nim' => '22410100011', 'nilai_ipk' => 3.81],
            ['id_ipk' => 'I4', 'nim' => '22410100048', 'nilai_ipk' => 3.84],
            ['id_ipk' => 'I5', 'nim' => '22410100055', 'nilai_ipk' => 3.24],
            ['id_ipk' => 'I6', 'nim' => '22410100070', 'nilai_ipk' => 3.96],
            ['id_ipk' => 'I7', 'nim' => '22410100041', 'nilai_ipk' => 3.70],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('ipk');
    }
};
