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
        Schema::create('salary_ranges', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('min_salary');
            $table->bigInteger('max_salary');
            $table->string('label')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['min_salary', 'max_salary']);
        });
        DB::statement("
            CREATE INDEX salary_ranges_active_idx
            ON salary_ranges (min_salary, max_salary)
            WHERE is_active = true
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP INDEX IF EXISTS salary_ranges_active_idx");
        Schema::dropIfExists('salary_ranges');
    }
};
