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
        Schema::create('recruiter_profiles', function (Blueprint $table) {
             $table->bigIncrements('id');

            $table->unsignedBigInteger('recruiter_id');

            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('designation')->nullable();
            $table->string('department')->nullable();

            $table->string('phone')->nullable();
            $table->text('bio')->nullable();
            $table->string('profile_photo')->nullable();

            $table->timestamps();

            $table->unique('recruiter_id');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recruiter_profiles');
    }
};
