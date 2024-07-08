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
            $table->string('pekerjaan');
            $table->string('pendapatan');
            $table->string('bidang_kerja');
            $table->string('alamat_kerja');
            $table->integer('poskod_kerja');
            $table->string('daerah_kerja');
            $table->string('negeri_kerja');
            $table->string('nama_majikan');
            $table->string('no_tel_majikan');
            $table->string('status_kemaskini');
            $table->timestamps();
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
