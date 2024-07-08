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
            $table->string('hubungan_waris');
            $table->string('nama_waris');
            $table->string('no_tel_waris');
            $table->string('alamat_waris');
            $table->integer('poskod_waris');
            $table->string('daerah_waris');
            $table->string('negeri_waris');
            $table->string('status_kemaskini');
            $table->timestamps();
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
