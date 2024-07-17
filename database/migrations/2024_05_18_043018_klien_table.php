<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\KlienUpdateRequest;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('klien', function (Blueprint $table) {
            $table->id();
            $table->string('no_kp')->unique();
            $table->string('nama');
            $table->string('no_tel');
            $table->string('emel');
            $table->string('alamat_rumah');
            $table->integer('poskod');
            $table->string('daerah');
            $table->string('negeri');
            $table->string('jantina');
            $table->string('agama');
            $table->string('bangsa');
            $table->string('tahap_pendidikan');
            $table->string('status_kesihatan_mental');
            $table->string('status_oku');
            $table->double('skor_ccri');
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
