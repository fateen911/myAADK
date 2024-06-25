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
        Schema::create('respon_modal_kepulihan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('klien_id');
            $table->unsignedBigInteger('soalan_id'); 
            $table->unsignedBigInteger('skala_id')->nullable();
            $table->enum('status', ['Selesai', 'Belum Selesai'])->default('Belum Selesai');
            $table->timestamps();

            $table->foreign('klien_id')->references('id')->on('kliens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respon_modal_kepulihan');
    }
};
