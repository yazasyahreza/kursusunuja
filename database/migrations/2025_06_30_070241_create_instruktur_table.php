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
        Schema::create('instruktur', function (Blueprint $table) {
            $table->increments('id_instruktur');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('set null');
            $table->string('bidang_keahlian', 100)->nullable();
            $table->string('no_telepon', 20)->nullable();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instruktur');
    }
};
