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
        Schema::create('Alamat_calon_baptis', function (Blueprint $table) {
            $table->id('alamatBaptisID')->primary();
            $table->string('baptisID');
            $table->foreign('baptisID') 
                  ->references('baptisID')->on('calonBaptis') 
                  ->onDelete('cascade'); 
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('namaJalan');
            $table->string(column: 'RT');
            $table->string(column: 'RW');
            $table->string('kodePos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Alamat_calon_baptis');
    }
};
