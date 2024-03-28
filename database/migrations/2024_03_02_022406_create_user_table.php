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
        Schema::create('user', function (Blueprint $table) {
            $table->id('id_user',11);
            $table->string('email_user',100)->nullable(false);
            $table->text('password_user')->nullable(false);
            $table->string('nama_user',50)->nullable(false);
            $table->string('alamat_user',300)->nullable(false);
            $table->string('no_hp_user',13)->nullable(false);
            $table->text('foto_user')->nullable(false);
            $table->enum('level_user', ['user', 'admin'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
