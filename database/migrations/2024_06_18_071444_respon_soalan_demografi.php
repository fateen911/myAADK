<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('respon_soalan_demografi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('klien_id');
            $table->string('rawatan');
            $table->string('lain_lain_rawatan')->nullable();
            $table->string('pusat_rawatan');
            $table->string('tempoh_tidak_ambil_dadah');
            $table->string('kategori');
            $table->string('jumlah_relapse')->nullable();
            $table->json('jenis_dadah');  // Store as JSON
            $table->string('jenis_kediaman');
            $table->string('tempoh_tinggal_lokasi_terkini');
            $table->string('tinggal_dengan');
            $table->string('kawasan_tempat_tinggal');
            $table->string('sesi');
            $table->enum('status', ['Selesai', 'Belum Selesai'])->default('Belum Selesai');
            $table->timestamps();

            // Assuming you have a 'kliens' table with an 'id' column
            $table->foreign('klien_id')->references('id')->on('klien')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respon_soalan_demografi');
    }
};
