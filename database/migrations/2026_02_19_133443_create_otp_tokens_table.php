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
        Schema::create('otp_tokens', function (Blueprint $table) {
           

            $table->bigIncrements('id');

            // phone OR email
            $table->string('identifier', 191);

            // phone | email
            $table->string('identifier_type', 20);

            // Store HASHED OTP only
            $table->string('otp_hash', 255);

            // Expiry time (5 min recommended)
            $table->timestampTz('expires_at');

            // Security
            $table->unsignedSmallInteger('attempts')->default(0);

            $table->timestampTz('verified_at')->nullable();

            $table->timestampsTz();

            // 🔥 Critical Index (Fast verification lookup)
            $table->index(['identifier', 'expires_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otp_tokens');
    }
};
