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
        Schema::create('conversations', function (Blueprint $table) {
            
           $table->bigIncrements('id');

            // Two users in the conversation
            $table->unsignedBigInteger('user_one_id');
            $table->unsignedBigInteger('user_two_id');

            // Optional: if chat is related to job application
            $table->unsignedBigInteger('job_application_id')->nullable();

            $table->unsignedBigInteger('last_message_id')->nullable();
            $table->timestamp('last_message_at')->nullable();

            $table->timestamps();

            // Index for fast lookup
            $table->unique(['user_one_id','user_two_id']);
            $table->index('job_application_id');
            $table->index('last_message_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
