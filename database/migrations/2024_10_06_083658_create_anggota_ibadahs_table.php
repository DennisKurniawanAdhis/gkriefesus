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
        Schema::create('anggota_jenisIbadah', function (Blueprint $table) {
            $table->string('anggotaID');
            $table->foreign('anggotaID') 
                  ->references('anggotaID')->on('anggota')
                  ->onDelete('cascade'); 
            $table->string('ibadahID');
            $table->foreign('ibadahID') 
                  ->references('ibadahID')->on('jenisIbadah') 
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_jenisIbadah');
    }
};
