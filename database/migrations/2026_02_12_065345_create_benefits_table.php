<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('benefits', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            // health_insurance, pf, work_from_home

            $table->string('label');
            // Health Insurance, PF, Work From Home

            $table->string('icon')->nullable();
            // optional icon class or image reference

            $table->smallInteger('sort_order')->default(0);

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });

        // Partial index for active benefits
        DB::statement("
            CREATE INDEX benefits_active_idx
            ON benefits (sort_order)
            WHERE is_active = true
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('benefits');
    }
};
