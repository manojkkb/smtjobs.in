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
        Schema::create('interviews', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('job_application_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamp('scheduled_at');
            $table->string('mode'); // online, offline
            $table->string('location')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index('job_application_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};
