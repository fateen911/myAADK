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
            $table->string('status_perkahwinan');
            $table->string('nama_pasangan');
            $table->string('no_tel_pasangan');
            $table->string('bilangan_anak');
            $table->integer('alamat_pasangan');
            $table->integer('poskod_pasangan');
            $table->string('daerah_pasangan');
            $table->string('negeri_pasangan');
            $table->string('alamat_kerja_pasangan');
            $table->integer('poskod_kerja_pasangan');
            $table->string('daerah_kerja_pasangan');
            $table->string('negeri_kerja_pasangan');
            $table->enum('status_kemaskini', ['Baharu','Kemaskini', 'Lulus', 'Ditolak'])->default('Baharu');
            $table->timestamps();
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
