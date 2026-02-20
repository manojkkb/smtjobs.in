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
        Schema::create('job_post_benefits', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('job_post_id')
                  ->constrained('job_posts')
                  ->cascadeOnDelete();

            $table->foreignId('benefit_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->timestamps();

            // Prevent duplicate benefit per job
            $table->unique(['job_post_id', 'benefit_id']);

            // Important index for filtering
            $table->index(['benefit_id', 'job_post_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_post_benefits');
    }
};
