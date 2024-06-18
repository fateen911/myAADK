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
            $table->unsignedBigInteger('soalan_id'); //kombinasi modal,kategori,no soalan (BB5)
            $table->unsignedBigInteger('skala_id');
            $table->enum('status', ['Selesai', 'Tidak Selesai'])->default('Tidak Selesai');
            $table->timestamps();
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
