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
        Schema::create('job_applications', function (Blueprint $table) {
             $table->bigIncrements('id');

            $table->foreignId('candidate_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('job_post_id')
                ->constrained('job_posts')
                ->cascadeOnDelete();

            $table->foreignId('application_status_id')
                ->constrained('application_statuses')
                ->cascadeOnDelete();

            $table->text('cover_letter')->nullable();
            $table->string('resume_snapshot')->nullable();

            $table->timestamp('applied_at')->nullable();

            $table->timestamps();

            $table->unique(['candidate_id', 'job_post_id']);

            $table->index('job_post_id');
            $table->index('candidate_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
