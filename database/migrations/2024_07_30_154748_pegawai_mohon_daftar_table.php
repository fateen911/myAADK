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
        Schema::create('pegawai_mohon_daftar', function (Blueprint $table) {
            $table->id();
            $table->string('no_kp');
            $table->string('nama');
            $table->string('emel');
            $table->string('no_tel')->nullable();
            $table->string('jawatan');
            $table->string('peranan');
            $table->string('negeri_bertugas')->nullable();
            $table->string('daerah_bertugas')->nullable();
            $table->enum('status', ['Baharu','Lulus','Ditolak'])->default('Baharu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_mohon_daftar');
    }
};
