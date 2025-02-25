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
        Schema::create('rawatan_klien', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('klien_id');
            $table->integer('id_pk');
            $table->integer('id_ki');
            $table->string('tkh_perintah');
            $table->date('tkh_mula_pengawasan');
            $table->date('tkh_tamat_pengawasan');
            $table->string('seksyen');
            $table->string('puspen');
            $table->string('pejabat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rawatan_klien');
    }
};
