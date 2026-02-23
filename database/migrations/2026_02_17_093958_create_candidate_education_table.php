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
        Schema::create('candidate_education', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('candidate_id');

            $table->unsignedBigInteger('education_level_id');
            $table->unsignedBigInteger('education_degree_id')->nullable();
            $table->unsignedBigInteger('education_specialization_id')->nullable();

            $table->string('institute_name', 150)->nullable();
            $table->string('board_university', 150)->nullable();

            $table->unsignedSmallInteger('passing_year')->nullable();

            $table->decimal('percentage', 5, 2)->nullable();
            $table->decimal('cgpa', 4, 2)->nullable();
            $table->decimal('cgpa_scale', 3, 1)->nullable();

            $table->boolean('is_current')->default(false);

            $table->timestamps();

            $table->index('candidate_id');
            $table->index('education_level_id');
            $table->index('education_degree_id');
            $table->index('education_specialization_id');

            // Composite index for fast filtering
            $table->index([
                'education_level_id',
                'education_degree_id',
                'education_specialization_id'
            ], 'education_filter_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_education');
    }
};
