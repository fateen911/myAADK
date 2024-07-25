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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->string('no_kp');
            $table->string('nama');
            $table->string('emel');
            $table->string('no_tel')->nullable();
            $table->string('jawatan');
            $table->string('peranan');
            $table->string('negeri_bertugas')->nullable();
            $table->string('daerah_bertugas')->nullable();
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
