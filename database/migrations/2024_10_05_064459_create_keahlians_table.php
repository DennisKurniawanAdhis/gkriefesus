<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keahlian', function (Blueprint $table) {
            $table->string('keahlianID')->primary();
            $table->string('namaKeahlian');
            $table->text('deskripsi');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('keahlian');
    }
};