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
        Schema::create('shortlisted_candidates', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('recruiter_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('candidate_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('job_post_id')
                ->nullable()
                ->constrained('job_posts')
                ->nullOnDelete();

            $table->timestamps();

            $table->index(['recruiter_id', 'candidate_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shortlisted_candidates');
    }
};
