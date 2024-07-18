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
        Schema::create('pekerjaan_klien', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('klien_id');
            $table->string('status_kerja');
            $table->string('bidang_kerja')->nullable();
            $table->string('nama_kerja')->nullable();
            $table->string('pendapatan')->nullable();
            $table->string('kategori_majikan')->nullable();
            $table->string('nama_majikan')->nullable();
            $table->string('no_tel_majikan')->nullable();
            $table->string('alamat_kerja')->nullable();
            $table->integer('poskod_kerja')->nullable();
            $table->string('daerah_kerja')->nullable();
            $table->string('negeri_kerja')->nullable();
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
        Schema::dropIfExists('pekerjaan_klien');
    }
};
