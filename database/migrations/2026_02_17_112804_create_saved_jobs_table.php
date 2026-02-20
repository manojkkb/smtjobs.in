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
        Schema::create('saved_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('candidate_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('job_post_id')
                ->constrained('job_posts')
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique(['candidate_id', 'job_post_id']);
            $table->index(['candidate_id', 'job_post_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saved_jobs');
    }
};
