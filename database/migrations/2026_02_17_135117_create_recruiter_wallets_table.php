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
        Schema::create('recruiter_wallets', function (Blueprint $table) {
             $table->bigIncrements('id');

            $table->foreignId('recruiter_id')
                ->unique()
                ->constrained('recruiters')
                ->cascadeOnDelete();

            $table->bigInteger('job_balance')->default(0);
            $table->bigInteger('database_balance')->default(0);
            $table->bigInteger('ai_balance')->default(0);

            $table->boolean('is_frozen')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recruiter_wallets');
    }
};
