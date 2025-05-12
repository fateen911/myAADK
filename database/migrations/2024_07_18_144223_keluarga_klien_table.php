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
        Schema::create('keluarga_klien', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('klien_id');
            $table->string('status_perkahwinan')->nullable();
            $table->string('nama_pasangan')->nullable();
            $table->string('no_tel_pasangan')->nullable();
            $table->string('bilangan_anak')->nullable();
            $table->string('alamat_pasangan')->nullable();
            $table->integer('poskod_pasangan')->nullable();
            $table->string('daerah_pasangan')->nullable();
            $table->string('negeri_pasangan')->nullable();
            $table->string('alamat_kerja_pasangan')->nullable();
            $table->integer('poskod_kerja_pasangan')->nullable();
            $table->string('daerah_kerja_pasangan')->nullable();
            $table->string('negeri_kerja_pasangan')->nullable();
            $table->enum('status_kemaskini', ['Baharu','Kemaskini', 'Lulus', 'Ditolak'])->default('Baharu');
            $table->timestamps();

            $table->foreign('klien_id')->references('id')->on('klien')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluarga_klien');
    }
};
