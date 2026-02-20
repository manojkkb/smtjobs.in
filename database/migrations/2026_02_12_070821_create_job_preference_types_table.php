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
        Schema::create('job_preference_types', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            // work_mode, salary, radius, industry, employment_type

            $table->string('label');
            // Work Mode, Salary Range, Preferred Industry

            $table->string('input_type')->nullable();
            // select, multi_select, range, radius, boolean

            $table->boolean('is_multiple')->default(false);
            // true if multiple selection allowed

            $table->boolean('is_active')->default(true);

            $table->smallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        DB::statement("
            CREATE INDEX job_preference_types_active_idx
            ON job_preference_types (sort_order)
            WHERE is_active = true
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP INDEX IF EXISTS job_preference_types_active_idx");
        Schema::dropIfExists('job_preference_types');
    }
};
