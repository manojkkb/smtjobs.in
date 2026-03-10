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
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('conversation_id');

            $table->unsignedBigInteger('sender_id');

            $table->text('message')->nullable();

            // text | request_contact | request_cv | request_email | share_contact | share_cv | share_email
            $table->string('type',30)->default('text');

            // request status
            $table->string('request_status',20)->nullable(); // pending, accepted, rejected

            // shared data
            $table->string('cv_file')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->boolean('is_seen')->default(false);

            $table->timestamps();

            $table->index('conversation_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
