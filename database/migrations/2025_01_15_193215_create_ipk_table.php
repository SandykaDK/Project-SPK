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
            ['id_ipk' => 'I1', 'nim' => '0110119001', 'nilai_ipk' => 3.5],
            ['id_ipk' => 'I2', 'nim' => '0110119002', 'nilai_ipk' => 3.6],
            ['id_ipk' => 'I3', 'nim' => '0110119003', 'nilai_ipk' => 3.7],
            ['id_ipk' => 'I4', 'nim' => '0110119004', 'nilai_ipk' => 3.8],
            ['id_ipk' => 'I5', 'nim' => '0110119005', 'nilai_ipk' => 3.9],
            ['id_ipk' => 'I6', 'nim' => '0110119006', 'nilai_ipk' => 3.4],
            ['id_ipk' => 'I7', 'nim' => '0110119007', 'nilai_ipk' => 3.3],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('ipk');
    }
};
