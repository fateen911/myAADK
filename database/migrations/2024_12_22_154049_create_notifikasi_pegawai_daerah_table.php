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
        Schema::create('notifikasi_pegawai_daerah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('klien_id');
            $table->string('message1');
            $table->string('message2');
            $table->string('daerah_aadk_baru');
            $table->string('daerah_aadk_lama');
            $table->boolean('is_read1')->default(false);
            $table->boolean('is_read2')->default(false);
            $table->timestamps();

            $table->foreign('klien_id')->references('id')->on('klien')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasi_pegawai_daerah');
    }
};
