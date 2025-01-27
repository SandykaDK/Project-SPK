<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('periode', function (Blueprint $table) {
            $table->id();
            $table->string('id_periode')->unique();
            $table->year('tahun_periode');
            $table->timestamps();
        });

        DB::table('periode')->insert([
            ['id_periode' => '2k24', 'tahun_periode' => '2024'],
            ['id_periode' => '2k25', 'tahun_periode' => '2025'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('periode');
    }
};
