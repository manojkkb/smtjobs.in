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
        Schema::create('job_post_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('job_post_id');

            $table->string('title');
            $table->text('description');
            $table->text('requirements')->nullable();
            $table->text('responsibilities')->nullable();

            $table->timestamps();

            $table->unique('job_post_id');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_post_profiles');
    }
};
