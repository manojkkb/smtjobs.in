<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_roles', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('category_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->string('label');
            $table->string('slug');

            $table->text('description')->nullable();
            $table->string('icon')->nullable();

            $table->boolean('is_active')->default(true);
            $table->smallInteger('sort_order')->default(0);

            $table->timestamps();
            // Unique slug per category
            $table->unique(['category_id', 'slug']);

            // Basic index
            $table->index(['category_id', 'is_active']);
        });
         // PostgreSQL Partial Index (active roles per category)
        DB::statement("
            CREATE INDEX job_roles_active_sort_idx
            ON job_roles (category_id, sort_order)
            WHERE is_active = true
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP INDEX IF EXISTS job_roles_active_sort_idx");
        Schema::dropIfExists('job_roles');
    }
};
