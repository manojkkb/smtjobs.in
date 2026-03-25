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
        Schema::create('company_reviews', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('user_id')->nullable();

            $table->tinyInteger('rating')->nullable();
            $table->tinyInteger('interview_process_rating')->nullable();
            $table->tinyInteger('communication_rating')->nullable();
            $table->tinyInteger('salary_rating')->nullable();
            $table->tinyInteger('work_culture_rating')->nullable();

            $table->text('review')->nullable();
            $table->text('pros')->nullable();
            $table->text('cons')->nullable();

            $table->boolean('is_anonymous')->default(false);
            $table->tinyInteger('status')->default(1);

            $table->timestamps();

            $table->index('company_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_reviews');
    }
};
