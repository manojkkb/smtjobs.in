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
        Schema::create('job_alerts', function (Blueprint $table) {
            $table->bigIncrements('id');

         $table->foreignId('candidate_id')
          ->constrained()
          ->cascadeOnDelete();

        $table->string('name'); // e.g. "IT Jobs in Indore"

        // Filters
        $table->unsignedBigInteger('city_id')->nullable();
        $table->unsignedBigInteger('category_id')->nullable();
        $table->unsignedBigInteger('experience_range_id')->nullable();
        $table->unsignedBigInteger('employment_type_id')->nullable();

        $table->bigInteger('min_salary')->nullable();
        $table->boolean('is_remote')->default(false);

        $table->string('frequency')->default('daily'); 
        // daily, weekly

        $table->boolean('is_active')->default(true);

        $table->timestamps();

        $table->index('candidate_id');
        $table->index(['city_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_alerts');
    }
};
