<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        // Mengecek apakah tabel 'ibadah' sudah ada atau belum
        if (!Schema::hasTable('ibadah')) {
            Schema::create('ibadah', function (Blueprint $table) {
                $table->id('dataIbadahID');
                $table->string('ibadahID'); // Kolom ibadahID
                $table->foreign('ibadahID') 
                    ->references('ibadahID')->on('jenisIbadah') // Relasi ke jenisIbadah
                    ->onDelete('cascade'); // Hapus ibadah jika jenisIbadah dihapus
                
                $table->string('pendetaID'); // Kolom pendetaID
                $table->foreign('pendetaID') 
                    ->references('pendetaID')->on('pendeta') // Relasi ke pendeta
                    ->onDelete('cascade'); // Hapus ibadah jika pendeta dihapus
                
                $table->date('tanggalIbadah'); // Kolom tanggal ibadah
                $table->text('deskripsi'); // Kolom untuk teks atau deskripsi
            });
        }
    }

    public function down()
    {
        // Menghapus tabel 'ibadah' jika migration di-rollback
        Schema::dropIfExists('ibadah');
    }
};
