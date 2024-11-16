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
        Schema::create('anggota', function (Blueprint $table) {
            $table->string('anggotaID')->primary();
            $table->string('komisiID')->nullable();
            $table->foreign('komisiID') // Menjadikan komisiID sebagai foreign key
                  ->references('komisiID')->on('komisi') // Mereferensikan ke kolom komisiID di tabel komisi
                  ->onDelete('set null'); // Aturan penghapusan cascading jika diperlukan
            $table->string('noTelp');
            $table->string('namaDepanAnggota');
            $table->string('namaBelakangAnggota');
            $table->date('tanggalLahir');
            $table->string('tempatLahir');
            $table->enum('jenisKelamin', ['pria', 'wanita'])->default('pria');   
            $table->enum('statusKawin', ['Belum Menikah', 'Sudah Menikah','Duda','Janda'])->default('Belum Menikah');   
            $table->string(column: 'noKK');
            $table->string(column: 'NIK');
            $table->string(column: 'pekerjaan');
            $table->string('jabatan')->nullable();

        });



       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota');
        
    }
};
