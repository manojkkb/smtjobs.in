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
        Schema::create('candidate_skills', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('candidate_id')->constrained()->cascadeOnDelete();
            $table->foreignId('skill_id')->constrained()->cascadeOnDelete();

            $table->integer('experience_years')->default(0);

            $table->timestamps();

            $table->unique(['candidate_id', 'skill_id']);
            $table->index(['skill_id', 'candidate_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_skills');
    }
};
