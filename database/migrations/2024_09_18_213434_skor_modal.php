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
        Schema::create('skor_modal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('klien_id');
            $table->string('sesi');
            $table->double('modal_fizikal');
            $table->double('modal_psikologi');
            $table->double('modal_sosial');
            $table->double('modal_persekitaran');
            $table->double('modal_insaniah');
            $table->double('modal_spiritual');
            $table->double('modal_rawatan');
            $table->double('modal_kesihatan');
            $table->double('modal_strategi_daya_tahan');
            $table->double('modal_resiliensi');
            $table->timestamps();

            $table->foreign('klien_id')->references('id')->on('klien')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skor_modal');
    }
};
