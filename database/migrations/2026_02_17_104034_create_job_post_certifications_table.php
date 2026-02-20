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
        Schema::create('job_post_certifications', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('job_post_id')
                  ->constrained('job_posts')
                  ->cascadeOnDelete();

            $table->foreignId('certificate_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Optional: required or preferred
            $table->boolean('is_mandatory')->default(true);

            $table->timestamps();

            // Prevent duplicate certification per job
            $table->unique(['job_post_id', 'certificate_id']);

            // Important for filtering by certification
            $table->index(['certificate_id', 'job_post_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_post_certifications');
    }
};
