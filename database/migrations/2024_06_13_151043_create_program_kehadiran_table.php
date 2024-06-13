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
        Schema::create('program_kehadiran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('program_id'); // Foreign key to program table
            $table->unsignedBigInteger('klien_id'); // Foreign key to klien table
            $table->unsignedBigInteger('pegawai_id')->nullable(); // Foreign key to user table
            $table->dateTime('tkh_pengesahan',0)->nullable();
            $table->string('pengesahan')->nullable();
            $table->string('catatan')->nullable();
            $table->dateTime('tkh_perekodan',0)->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('program_id')->references('id')->on('program')->onDelete('cascade');
            $table->foreign('klien_id')->references('id')->on('klien')->onDelete('cascade');
            $table->foreign('pegawai_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_kehadiran');
    }
};
