<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('krs', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement()->primary();
            $table->char('npm', 10);
            $table->char('kode_matakuliah', 8);
            $table->foreign('npm')->references('npm')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('kode_matakuliah')->references('kode_matakuliah')->on('matakuliah')->onDelete('cascade');
            $table->unique(['npm', 'kode_matakuliah']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('krs');
    }
};
