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
        Schema::create('candidate_experiences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('candidate_id')->constrained()->cascadeOnDelete();

            $table->string('company_name');
            $table->string('designation');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('is_current')->default(false);

            $table->timestamps();

            $table->index('candidate_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_experiences');
    }
};
