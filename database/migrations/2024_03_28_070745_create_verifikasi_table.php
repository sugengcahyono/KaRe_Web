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
        Schema::create('verifikasi', function (Blueprint $table) {
            $table->id('id_verification');
            $table->string('email_verification',100)->nullable(false);
            $table->string('otp_verification',6)->nullable(false);
            $table->enum('type_verification', ['SignUp', 'ForgotPass'])->nullable(false);
            $table->bigInteger('start_millis')->nullable(false);
            $table->bigInteger('end_millis')->nullable(false);
            $table->enum('device', ['Website', 'Mobile'])->nullable(false);
            $table->integer('resend')->nullable(false);
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
        Schema::dropIfExists('verifikasi');
    }
};
