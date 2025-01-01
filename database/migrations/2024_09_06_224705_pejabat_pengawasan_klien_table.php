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
        Schema::create('pejabat_pengawasan_klien', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('klien_id');
            $table->string('negeri_aadk_asal');
            $table->string('daerah_aadk_asal');
            $table->string('alamat_rumah_asal');
            $table->string('poskod_rumah_asal');
            $table->string('negeri_rumah_asal');
            $table->string('daerah_rumah_asal');
            
            $table->string('negeri_aadk_baru')->nullable();
            $table->string('daerah_aadk_baru')->nullable();
            $table->string('alamat_rumah_baru')->nullable();
            $table->string('poskod_rumah_baru')->nullable();
            $table->string('negeri_rumah_baru')->nullable();
            $table->string('daerah_rumah_baru')->nullable();

            $table->timestamps();

            $table->foreign('klien_id')->references('id')->on('klien')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pejabat_pengawasan_klien');
    }
};
