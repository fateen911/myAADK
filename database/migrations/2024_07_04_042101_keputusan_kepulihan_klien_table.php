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
        Schema::create('keputusan_kepulihan_klien', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('klien_id');
            $table->string('sesi');
            $table->unsignedBigInteger('tahap_kepulihan_id');
            $table->double('skor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keputusan_kepulihan_klien');
    }
};
