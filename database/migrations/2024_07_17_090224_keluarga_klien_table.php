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
            
            $table->string('nama_bapa');
            $table->string('no_kp_bapa');
            $table->string('no_tel_bapa');
            $table->string('alamat_bapa');
            $table->integer('poskod_bapa');
            $table->string('daerah_bapa');
            $table->string('negeri_bapa');
            $table->string('status_bapa');

            $table->string('nama_ibu');
            $table->string('no_kp_ibu');
            $table->string('no_tel_ibu');
            $table->string('alamat_ibu');
            $table->integer('poskod_ibu');
            $table->string('daerah_ibu');
            $table->string('negeri_ibu');
            $table->string('status_ibu');

            $table->string('nama_penjaga');
            $table->string('no_kp_penjaga');
            $table->string('no_tel_penjaga');
            $table->string('alamat_penjaga');
            $table->integer('poskod_penjaga');
            $table->string('daerah_penjaga');
            $table->string('negeri_penjaga');
            $table->string('status_penjaga');

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
