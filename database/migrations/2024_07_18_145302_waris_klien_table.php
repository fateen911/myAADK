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
        Schema::create('waris_klien', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('klien_id');
            
            $table->string('nama_bapa')->nullable();
            $table->string('no_kp_bapa')->nullable();
            $table->string('no_tel_bapa')->nullable();
            $table->string('alamat_bapa')->nullable();
            $table->integer('poskod_bapa')->nullable();
            $table->string('daerah_bapa')->nullable();
            $table->string('negeri_bapa')->nullable();
            $table->string('status_bapa')->nullable();

            $table->string('nama_ibu')->nullable();
            $table->string('no_kp_ibu')->nullable();
            $table->string('no_tel_ibu')->nullable();
            $table->string('alamat_ibu')->nullable();
            $table->integer('poskod_ibu')->nullable();
            $table->string('daerah_ibu')->nullable();
            $table->string('negeri_ibu')->nullable();
            $table->string('status_ibu')->nullable();

            $table->string('hubungan_penjaga')->nullable();
            $table->string('nama_penjaga')->nullable();
            $table->string('no_kp_penjaga')->nullable();
            $table->string('no_tel_penjaga')->nullable();
            $table->string('alamat_penjaga')->nullable();
            $table->integer('poskod_penjaga')->nullable();
            $table->string('daerah_penjaga')->nullable();
            $table->string('negeri_penjaga')->nullable();
            $table->string('status_penjaga')->nullable();

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
        Schema::dropIfExists('waris_klien');
    }
};
