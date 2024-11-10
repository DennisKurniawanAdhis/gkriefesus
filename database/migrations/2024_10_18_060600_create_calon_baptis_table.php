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
        Schema::create('calonBaptis', function (Blueprint $table) {
            $table->string('baptisID')->primary();
            $table->string('anggotaID');
            $table->foreign('anggotaID') 
                  ->references('anggotaID')->on('anggota') 
                  ->onDelete('restrict'); 
            $table->string('pendetaID'); 
            $table->foreign('pendetaID') 
                    ->references('pendetaID')->on('pendeta')
                    ->onDelete('restrict'); 
            $table->string('namaIbu'); 
            $table->string('namaAyah'); 
            $table->date('tanggalBaptis'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calonBaptis');
    }
};
