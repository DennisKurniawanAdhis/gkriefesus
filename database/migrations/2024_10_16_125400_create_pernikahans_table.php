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
        Schema::create('pernikahan', function (Blueprint $table) {
            $table->string('pernikahanID')->primary();
            $table->string('anggotaID_suami');
            $table->foreign('anggotaID_suami') 
                  ->references('anggotaID')->on('anggota') 
                  ->onDelete('cascade'); 
            $table->string('anggotaID_istri');
            $table->foreign('anggotaID_istri') 
                  ->references('anggotaID')->on('anggota') 
                  ->onDelete('cascade');   
            $table->string('pendetaID'); // Kolom pendetaID
            $table->foreign('pendetaID') 
                    ->references('pendetaID')->on('pendeta') // Relasi ke pendeta
                    ->onDelete('cascade'); // Hapus ibadah jika pendeta dihapus
            $table->date('tanggalPernikahan'); // Kolom tanggal ibadah
            $table->string('namaOrangKua'); // Kolom tanggal ibadah
            $table->text('noStbld'); // Kolom untuk teks atau deskripsi
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pernikahan');
    }
};
