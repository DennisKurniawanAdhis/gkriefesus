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
        Schema::create('alamat_anggota', function (Blueprint $table) {
            $table->id('alamatAnggotaID')->primary();
            $table->string('anggotaID');
            $table->foreign('anggotaID') 
                  ->references('anggotaID')->on('anggota') 
                  ->onDelete('restrict'); 
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
        Schema::dropIfExists('alamat_anggota');
    }
};
