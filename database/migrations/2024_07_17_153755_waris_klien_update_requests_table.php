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
        Schema::create('waris_klien_update_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('klien_id')->constrained('waris_klien')->onDelete('cascade');
            $table->integer('waris');
            $table->json('requested_data'); // Store the requested updates in JSON format
            $table->enum('status', ['Baharu','Kemaskini', 'Lulus', 'Ditolak'])->default('Kemaskini');
            $table->json('alasan_ditolak')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('waris_klien_update_requests');
    }
};
