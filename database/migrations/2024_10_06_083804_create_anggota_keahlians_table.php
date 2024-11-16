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
        Schema::create('anggota_keahlian', function (Blueprint $table) {
            $table->string('anggotaID');
            $table->foreign('anggotaID') 
                  ->references('anggotaID')->on('anggota') 
                  ->onDelete('cascade'); 
            $table->string('keahlianID');
            $table->foreign('keahlianID') 
                  ->references('keahlianID')->on('keahlian') 
                  ->onDelete('restrict'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_keahlian');
    }
};
