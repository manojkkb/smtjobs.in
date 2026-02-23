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
        Schema::create('experience_ranges', function (Blueprint $table) {
            $table->id();
            
            // nullable for "10+ years"
            $table->string('slug')->unique();
            $table->string('label');
            // 0-1 Years, 2-5 Years, 10+ Years
            $table->integer('min_years');
            $table->integer('max_years')->nullable();

            $table->boolean('is_active')->default(true);
            $table->smallInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index(['min_years', 'max_years']);
            
        });

         // Partial index for active ranges
        DB::statement("
            CREATE INDEX experience_ranges_active_idx
            ON experience_ranges (sort_order)
            WHERE is_active = true
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP INDEX IF EXISTS experience_ranges_active_idx");
        Schema::dropIfExists('experience_ranges');
    }
};
