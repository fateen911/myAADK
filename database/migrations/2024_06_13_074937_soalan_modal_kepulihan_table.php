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
        Schema::create('soalan_modal_kepulihan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('modal_id');
            $table->unsignedBigInteger('kategori_id');
            $table->string('no_soalan');
            $table->string('soalan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soalan_modal_kepulihan');
    }
};
