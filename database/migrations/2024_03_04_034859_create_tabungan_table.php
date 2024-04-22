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
        Schema::create('tabungan', function (Blueprint $table) {
            $table->id('id_tabungan');
            $table->date('tgl_tabungan')->nullable(false);
            $table->string('ketsampah_tabungan', 100)->nullable(false);
            $table->integer('beratsampah_tabungan')->nullable(false);
            $table->enum('tipe_tabungan', ['masuk', 'keluar'])->nullable(false);
            $table->integer('hargasampah_tabungan')->nullable(false);
            $table->integer('saldoakhir_tabungan')->nullable(false);
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
        Schema::dropIfExists('tabungan');
    }
};
