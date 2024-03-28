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
        Schema::create('produk', function (Blueprint $table) {
            $table->id('id_produk');
            $table->string('nama_produk',100)->nullable(false);
            $table->text('foto_produk')->nullable(false);
            $table->integer('harga_produk', 11)->nullable(false);
            $table->string('deskripsi_produk',500)->nullable(false);
            $table->integer('stok_produk',11)->nullable(false);
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
        Schema::dropIfExists('produk');
    }
};
