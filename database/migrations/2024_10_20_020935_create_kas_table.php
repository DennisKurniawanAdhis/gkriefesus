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
        Schema::create('kas', function (Blueprint $table) {
            $table->id('kasID')->primary();
            $table->string('anggotaID')->nullable();
            $table->foreign('anggotaID') 
                  ->references('anggotaID')->on('anggota') 
                  ->onDelete('cascade'); 
            $table->string('ibadahID')->nullable();
            $table->foreign('ibadahID') 
                  ->references('ibadahID')->on('jenisIbadah') 
                  ->onDelete('cascade'); 
            $table->unsignedBigInteger('dataIbadahID')->nullable();
            $table->foreign('dataIbadahID') 
                  ->references('dataIbadahID')->on('ibadah') 
                  ->onDelete('cascade'); 
            $table->date('tanggal');
            $table->text('deskripsi')->nullable();
            $table->string('jenisUang')->nullable();;
            $table->string('namaPenyumbang')->nullable();;
            $table->decimal('jumlahUang', 15, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kas');
    }
};
