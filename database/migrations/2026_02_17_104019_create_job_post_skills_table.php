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
        Schema::create('job_post_skills', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('job_post_id')
                  ->constrained('job_posts')
                  ->cascadeOnDelete();

            $table->foreignId('skill_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Optional: skill experience requirement
            $table->integer('experience_years')->nullable();

            $table->timestamps();

            // Prevent duplicate skill per job
            $table->unique(['job_post_id', 'skill_id']);

            // 🔥 Critical index for skill filtering
            $table->index(['skill_id', 'job_post_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_post_skills');
    }
};
