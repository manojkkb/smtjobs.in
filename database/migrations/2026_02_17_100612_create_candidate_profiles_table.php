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
        Schema::create('candidate_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('candidate_id')
                ->constrained()
                ->cascadeOnDelete();

            // Basic Info
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();

            // Contact
            $table->string('phone', 20)->nullable();
            $table->string('alternate_phone', 20)->nullable();

            // Profile Content
            $table->string('headline')->nullable();
            $table->text('summary')->nullable();

            // Media
            $table->string('profile_photo')->nullable();
            $table->string('resume_path')->nullable();

            // Status
            $table->boolean('is_profile_complete')->default(false);
            $table->timestamp('profile_completed_at')->nullable();

            $table->timestamps();

            $table->unique('candidate_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_profiles');
    }
};
