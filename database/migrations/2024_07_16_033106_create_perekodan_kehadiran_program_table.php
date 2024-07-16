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
        Schema::create('perekodan_kehadiran_program', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('program_id');
            $table->unsignedBigInteger('klien_id');
            $table->datetime('tarikh_perekodan');
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('program_id')->references('id')->on('program')->onDelete('cascade');
            $table->foreign('klien_id')->references('id')->on('klien')->onDelete('cascade');
            // 'onDelete('cascade')' ensures that when a category or lecturer is deleted, all related courses are also deleted
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perekodan_kehadiran_program', function (Blueprint $table) {
            // Drop foreign key constraints
            $table->dropForeign(['program_id']);
            $table->dropForeign(['klien_id']);
            // Drop columns
            $table->dropColumn('program_id');
            $table->dropColumn('klien_id');
        });
    }
};
