<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenisIbadah', function (Blueprint $table) {
            $table->string('ibadahID')->primary();
            $table->string('namaIbadah');
            $table->enum('hari', ['senin', 'selasa','rabu','kamis','jumat','sabtu','minggu'])->default('minggu');   
            $table->time('waktu');
            $table->string('lokasi');
            $table->text('deskripsi');
   
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('jenisIbadah');
    }
};