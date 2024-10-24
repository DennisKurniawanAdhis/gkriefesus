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
        Schema::create('pendeta', function (Blueprint $table) {
            $table->string('pendetaID')->primary();
            $table->string('namaDepanPendeta');
            $table->string('namaBelakangPendeta');
            $table->string('noTelp');
            $table->date('tanggalLahir');
            $table->string('tempatLahir');
            $table->enum('jenisKelamin', ['pria', 'wanita'])->default('pria');   
            $table->enum('statusKawin', ['Belum Menikah', 'Sudah Menikah','Duda','Janda'])->default('Belum Menikah');   
            $table->string(column: 'noKK');
            $table->string(column: 'NIK');
            $table->string(column: 'pekerjaan');
            $table->string('gelar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendeta');
    }
};
