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
        Schema::create('senarai_negeri_pejabat', function (Blueprint $table) {
            $table->id();
            $table->integer('negeri_id');
            $table->string('negeri');
            $table->string('alamat');
            $table->string('no_tel');
            $table->string('no_fax');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('senarai_negeri_pejabat');
    }
};
