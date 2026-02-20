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
        Schema::create('job_application_status_logs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('job_application_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('application_status_id')
                ->constrained('application_statuses')
                ->cascadeOnDelete();

            $table->text('remarks')->nullable();

            $table->timestamps();

            $table->index('job_application_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_application_status_logs');
    }
};
