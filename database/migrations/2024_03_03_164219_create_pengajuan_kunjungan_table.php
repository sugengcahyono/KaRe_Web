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
        Schema::create('kunjungan', function (Blueprint $table) {
            $table->id('id_kunjungan');
            $table->string('nama_kunjungan', 100)->nullable(false);
            $table->string('alamat_kunjungan', 300)->nullable(false);
            $table->date('tgl_kunjungan')->nullable(false);
            $table->string('namainstansi_kunjungan', 100)->nullable(false);
            $table->string('nohp_kunjungan', 15)->nullable(false);
            $table->string('tujuan_kunjungan', 500)->nullable(false);
            $table->enum('status_kunjungan', ['diajukan', 'diterima', 'ditolak'])->nullable(false);
            $table->integer('jumlah_kunjungan')->nullable(false);
            $table->string('alasanstatus_kunjungan', 300)->nullable(true);
            $table->timestamps();
            
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_kunjungan');
    }
};
