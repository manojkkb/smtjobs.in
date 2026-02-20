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
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Receiver (candidate or recruiter — both are users)
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Notification type reference
            $table->foreignId('notification_type_id')
                  ->constrained('notification_types')
                  ->cascadeOnDelete();

            // Content
            $table->string('title');
            $table->text('message');

            // Related model reference (job, application etc.)
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->string('reference_type')->nullable();
            // example: job_post, job_application

            // Status
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();

            $table->timestamps();

            /*
             |--------------------------------------------------------------------------
             | Index Strategy (Very Important)
             |--------------------------------------------------------------------------
             */

            // Fast unread query
            $table->index(['user_id', 'is_read']);

            // Fast latest notifications query
            $table->index(['user_id', 'created_at']);

            // Fast lookup by related entity
            $table->index(['reference_type', 'reference_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
