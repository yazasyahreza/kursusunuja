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
        Schema::create('peserta_kursus', function (Blueprint $table) {
            $table->increments('id_peserta_kursus');
            $table->unsignedInteger('kursus_id');
            $table->foreign('kursus_id')->references('id_kursus')->on('kursus')->onDelete('cascade');
            $table->unsignedInteger('peserta_id');
            $table->foreign('peserta_id')->references('id_peserta')->on('peserta')->onDelete('cascade');
            $table->enum('status', ['active', 'inactive'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_kursus');
    }
};
