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
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->foreignId('industry_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->string('slug')->unique();
            $table->string('label');

            $table->text('description')->nullable();
            $table->string('icon')->nullable();

            $table->boolean('is_active')->default(true);
            $table->smallInteger('sort_order')->default(0);

            $table->timestamps();

             // Unique slug per industry
            $table->unique(['industry_id', 'slug']);

            // Basic index
            $table->index(['industry_id', 'is_active']);
        });
        DB::statement("
            CREATE INDEX categories_active_idx
            ON categories (sort_order)
            WHERE is_active = true
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP INDEX IF EXISTS categories_active_idx");
        Schema::dropIfExists('categories');
    }
};
