<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->foreignId('company_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('recruiter_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('industry_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            $table->foreignId('category_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            $table->foreignId('city_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            $table->foreignId('employment_type_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            $table->foreignId('experience_range_id')
                  ->nullable()
                  ->constrained('experience_ranges')
                  ->nullOnDelete();

            $table->bigInteger('min_salary')->nullable();
            $table->bigInteger('max_salary')->nullable();

            $table->boolean('is_remote')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);

            $table->timestamp('published_at')->nullable();
            $table->timestamp('expires_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Core search indexes
            $table->index(['city_id', 'experience_range_id']);
            $table->index('company_id');
            $table->index('industry_id');
        });

        DB::statement("
            CREATE INDEX job_posts_active_idx
                ON job_posts (city_id, experience_range_id, published_at DESC)
                WHERE is_active = true;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP INDEX IF EXISTS job_posts_active_idx");
        Schema::dropIfExists('job_posts');
    }
};
