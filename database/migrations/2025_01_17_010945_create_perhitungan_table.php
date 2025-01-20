<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perhitungan', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('nim');
            $table->double('normalisasi1');
            $table->double('normalisasi2');
            $table->double('normalisasi3');
            $table->double('normalisasi4');
            $table->double('normalisasi5');
            $table->double('preferensi1');
            $table->double('preferensi2');
            $table->double('preferensi3');
            $table->double('preferensi4');
            $table->double('preferensi5');
            $table->double('hasil');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perhitungan');
    }
};
