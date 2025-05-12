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
            $table->unsignedBigInteger('user_id'); //yg daftar program
            $table->unsignedBigInteger('kategori_id');
            $table->string('negeri_pejabat');
            $table->string('daerah_pejabat');
            $table->string('custom_id'); //id program yang diubahsuai
            $table->string('nama');
            $table->string('objektif');
            $table->datetime('tarikh_mula');
            $table->datetime('tarikh_tamat');
            $table->string('tempat');
            $table->string('negeri');
            $table->string('daerah');
            $table->string('penganjur')->nullable();
            $table->string('nama_pegawai'); //yg terlibat sewaktu program dijalankan
            $table->string('no_tel_dihubungi');
            $table->string('catatan')->nullable();
            $table->string('pautan_pengesahan');
            $table->string('qr_pengesahan');
            $table->string('pautan_perekodan');
            $table->string('qr_perekodan');
            $table->string('status');
            $table->integer('version');
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('kategori_id')->references('id')->on('kategori_program')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('pegawai')->onDelete('cascade');
            // 'onDelete('cascade')' ensures that when a category or lecturer is deleted, all related courses are also deleted
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('program', function (Blueprint $table) {
            // Drop foreign key constraints
            $table->dropForeign(['kategori_id']);
            $table->dropForeign(['user_id']);
            // Drop columns
            $table->dropColumn('kategori_id');
            $table->dropColumn('user_id');
        });
    }
};
