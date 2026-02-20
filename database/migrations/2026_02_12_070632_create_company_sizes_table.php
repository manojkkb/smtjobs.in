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
        Schema::create('company_sizes', function (Blueprint $table) {
            $table->id();
             $table->string('slug')->unique();
            // micro, small, medium, large, enterprise

            $table->string('label');
            // 1-10 Employees, 10-50 Employees

            $table->integer('min_employees')->nullable();
            $table->integer('max_employees')->nullable();

            $table->smallInteger('sort_order')->default(0);

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            
        });

        DB::statement("
            CREATE INDEX company_sizes_range_idx
            ON company_sizes (min_employees, max_employees)
        ");

        DB::statement("
            CREATE INDEX company_sizes_active_idx
            ON company_sizes (sort_order)
            WHERE is_active = true
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP INDEX IF EXISTS company_sizes_range_idx");
        DB::statement("DROP INDEX IF EXISTS company_sizes_active_idx");
        Schema::dropIfExists('company_sizes');
    }
};
