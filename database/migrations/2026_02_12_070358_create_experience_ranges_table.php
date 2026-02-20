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
            $table->integer('min_years');
            $table->integer('max_years')->nullable();
            // nullable for "10+ years"

            $table->string('label');
            // 0-1 Years, 2-5 Years, 10+ Years

            $table->smallInteger('priority')->default(0);

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index(['min_years', 'max_years']);
            
        });

         // Partial index for active ranges
        DB::statement("
            CREATE INDEX experience_ranges_active_idx
            ON experience_ranges (priority)
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
