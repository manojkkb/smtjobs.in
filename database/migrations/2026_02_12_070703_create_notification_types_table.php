<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notification_types', function (Blueprint $table) {
            $table->id();

            // Unique code reference (used in backend)
            $table->string('slug')->unique();
            // example: job_applied, job_shortlisted, profile_viewed

            // Display label
            $table->string('label');

            // Optional description (admin clarity)
            $table->string('description')->nullable();

            // Channel control (default behaviour)
            $table->boolean('email_enabled')->default(true);
            $table->boolean('push_enabled')->default(true);
            $table->boolean('sms_enabled')->default(false);
            $table->boolean('in_app_enabled')->default(true);

            // System control
            $table->boolean('is_system')->default(true);
            $table->boolean('is_active')->default(true);

            $table->smallInteger('sort_order')->default(0);

            $table->timestamps();
        });
          // Partial index for active notification types
         DB::statement("
            CREATE INDEX notification_types_active_idx
            ON notification_types (sort_order)
            WHERE is_active = true
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP INDEX IF EXISTS notification_types_active_idx");
        Schema::dropIfExists('notification_types');
    }
};
