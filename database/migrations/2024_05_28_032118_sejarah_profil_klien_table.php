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
        Schema::create('sejarah_pofil_klien', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('klien_id');
            $table->integer('status');
            $table->unsignedBigInteger('pengemaskini')->nullable();

            $table->foreign('klien_id')
              ->references('id')->on('klien')->onDelete('cascade');
            $table->foreign('pengemaskini')
              ->references('id')->on('users')->onDelete('cascade');     
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sejarah_pofil_klien');
    }
};
