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
        Schema::create('pengajuan_kunjungan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kunjungan');
            $table->string('alamat_kunjungan');
            $table->date('tanggal_kunjungan');
            $table->string('nama_instansi_kunjungan');
            $table->string('no_hp_kunjungan');
            $table->string('tujuan_kunjungan');
            $table->enum('status_kunjungan', ['diajukan', 'diterima', 'ditolak']);
            $table->text('alasan_status_kunjungan');
            $table->timestamps();
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
