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
        Schema::create('program', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penganjur_id'); // Foreign key to user table
            $table->string('nama');
            $table->string('objektif');
            $table->string('tempat');
            $table->date('tarikh');
            $table->time('masa');
            $table->string('catatan')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('penganjur_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program');
    }
};
