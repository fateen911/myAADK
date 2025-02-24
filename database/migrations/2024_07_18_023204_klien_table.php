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
        Schema::create('klien', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pk');
            $table->integer('id_ki');
            $table->string('no_kp')->unique();
            $table->string('nama');
            $table->string('no_tel')->nullable();
            $table->string('emel')->nullable();
            $table->string('alamat_rumah');
            $table->string('poskod');
            $table->string('daerah');
            $table->string('negeri');
            $table->string('jantina');
            $table->string('agama');
            $table->string('bangsa');
            $table->string('tahap_pendidikan')->nullable();
            $table->string('penyakit')->nullable();
            $table->string('status_oku')->nullable();
            $table->double('skor_ccri')->nullable();
            $table->string('daerah_pejabat')->nullable();
            $table->string('negeri_pejabat')->nullable();
            $table->enum('status_kemaskini', ['Baharu','Kemaskini', 'Lulus', 'Ditolak'])->default('Baharu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('klien');
    }
};
