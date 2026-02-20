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
        Schema::create('candidates', function (Blueprint $table) {
           $table->bigIncrements('id');
           $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Location
            $table->foreignId('city_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

                // Experience
                $table->integer('total_experience_years')->default(0);
                $table->foreignId('experience_range_id')
                    ->nullable()
                    ->constrained('experience_ranges')
                    ->nullOnDelete();

                // Salary
                $table->bigInteger('expected_salary')->nullable();

                // Notice Period
                $table->foreignId('notice_period_id')
                    ->nullable()
                    ->constrained('notice_periods')
                    ->nullOnDelete();

                // Availability
                $table->boolean('open_to_work')->default(true);

                $table->timestamp('last_active_at')->nullable();

                $table->timestamps();
                $table->softDeletes();

                // Base Indexes
                $table->index(['city_id', 'experience_range_id']);
                $table->index('expected_salary');
        });

         DB::statement("
            CREATE INDEX candidates_open_search_idx
            ON candidates (city_id, experience_range_id, last_active_at DESC)
            WHERE open_to_work = true
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP INDEX IF EXISTS candidates_open_search_idx");
        Schema::dropIfExists('candidates');
    }
};
