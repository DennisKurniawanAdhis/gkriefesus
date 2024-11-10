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
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->id('pengeluaranID')->primary();
            $table->string('ibadahID')->nullable();
            $table->foreign('ibadahID') 
                  ->references('ibadahID')->on('jenisIbadah') 
                  ->onDelete('restrict'); 
            $table->text('deskripsi')->nullable();
            $table->date('tanggal');
            $table->string('jenisPengeluaran')->nullable();
            $table->decimal('jumlahUang', 15, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeluaran');
    }
};
